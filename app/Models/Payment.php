<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const MAX_PER_PAGE = 15;

    const TYPE_REGULAR = 'regular';
    const TYPE_ONE_OFF = 'one-off';

    const INTERVAL_ONCE = 'once';
    const INTERVAL_WEEKLY = 'weekly';
    const INTERVAL_MONTHLY = 'monthly';
    const INTERVAL_QUARTERLY = 'quarterly';
    const INTERVAL_HALF_YEARLY = 'half-yearly';
    const INTERVAL_YEARLY = 'yearly';

    const INTERVALS = [
        Payment::INTERVAL_WEEKLY,
        Payment::INTERVAL_MONTHLY,
        Payment::INTERVAL_QUARTERLY,
        Payment::INTERVAL_HALF_YEARLY,
        Payment::INTERVAL_YEARLY,
    ];

    use HasFactory;

    protected $fillable = [
        'creator_id',
        'type',
        'title',
        'amount',
        'category_id',
        'description',
        'interval',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'amount' => 'integer',
        'starts_at' => 'immutable_date',
        'ends_at' => 'immutable_date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getStartsAtForUser()
    {
        return date('d.m.Y', strtotime($this->starts_at));
    }

    public function getAmountForTable()
    {
        return number_format($this->amount / 100, 2, ',', '.') . ' €';
    }

    public function getAmountForForm()
    {
        $amount = $this->amount;
        if ($this->amount < 0) {
            $amount = $this->amount * (-1);
        }
        return substr_replace($amount, ',', -2, 0);
    }

    public function getEndsAtForUser()
    {
        if ($this->ends_at) {
            return date('d.m.Y', strtotime($this->ends_at));
        }

        if ($this->interval != Payment::INTERVAL_ONCE) {
            return 'endless';
        }

        return '';
    }

    public function isRegular()
    {
        return $this->type === Payment::TYPE_REGULAR;
    }

    public function isDebit(): int
    {
        if ($this->amount >= 0) {
            return 0;
        }
        return 1;
    }

    public function isEndless(): int
    {
        if ($this->ends_at != null) {
            return 0;
        }
        return 1;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) => $query->where('slug', $category)
            )
        );

        $query->when($filters['type'] ?? false, fn ($query, $type) =>
        $query->where(function ($query) use ($type) {
            if ($type == 'incoming') {
                $query->where('amount', '>=', '0');
            } else if ($type == 'outgoing') {
                $query->where('amount', '<', '0');
            }
        }));
    }

    public function isPayMonth(Carbon $date)
    {
        if (!$this->isActive($date)) {
            return false;
        }

        if ($this->interval === Payment::INTERVAL_MONTHLY) {
            return true;
        }

        if ($this->interval === Payment::INTERVAL_QUARTERLY) {
            return $this->isQuarterlyPayMonth($date);
        }

        if ($this->interval === Payment::INTERVAL_HALF_YEARLY) {
            return $this->isHalfYearlyPayMonth($date);
        }

        if ($this->interval === Payment::INTERVAL_YEARLY) {
            return $this->isYearlyPayMonth($date);
        }
    }

    private function isActive(Carbon $date)
    {
        if ($this->starts_at->greaterThan($date)) {
            return false;
        }

        if ($this->ends_at && $this->ends_at->lessThan($date)) {
            return false;
        }

        return true;
    }

    private function isQuarterlyPayMonth(Carbon $date)
    {
        $quarter1 = Carbon::create($this->starts_at);
        $quarter2 = $quarter1->copy()->addMonths(3);
        $quarter3 = $quarter2->copy()->addMonths(3);
        $quarter4 = $quarter3->copy()->addMonths(3);

        if (
            $date->month === $quarter1->month ||
            $date->month === $quarter2->month ||
            $date->month === $quarter3->month ||
            $date->month === $quarter4->month
        ) {
            return true;
        }

        return false;
    }

    private function isHalfYearlyPayMonth(Carbon $date)
    {
        $term1 = Carbon::create($this->starts_at);
        $term2 = $term1->copy()->addMonths(6);

        if (
            $date->month === $term1->month ||
            $date->month === $term2->month
        ) {
            return true;
        }

        return false;
    }

    private function isYearlyPayMonth(Carbon $date)
    {
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $this->starts_at)->firstOfMonth();

        if ($startDate->month === $date->month) {
            return true;
        }

        return false;
    }

    public static function regularCreditOfMonth($date): int
    {
        return Payment::ofMonth($date, Payment::TYPE_REGULAR, false);
    }

    public static function regularDebitOfMonth($date)
    {
        return Payment::ofMonth($date, Payment::TYPE_REGULAR, true);
    }

    public static function oneOffCreditOfMonth($date)
    {
        return Payment::ofMonth($date, Payment::TYPE_ONE_OFF, false);
    }

    public static function oneOffDebitOfMonth($date)
    {
        return Payment::ofMonth($date, Payment::TYPE_ONE_OFF, true);
    }

    public static function weeklyDebitOfMonth($date): int
    {


        return 0;
    }

    private static function ofMonth(
        $date,
        $type,
        $isDebit
    ) {
        $collection = Payment::where('type', $type)
            ->when(!$isDebit, function ($query) {
                $query->where('amount', '>=', 0);
            })
            ->when($isDebit, function ($query) {
                $query->where('amount', '<', 0);
            })
            ->get();

        $amount = $collection->filter(function ($payment) use ($date) {
            return $payment->isPayMonth($date);
        })->sum('amount');

        return $amount;
    }
}
