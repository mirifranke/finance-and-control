<?php

namespace App\Models;

use App\Services\PaymentService;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const MAX_PER_PAGE = 15;

    const ACCOUNT_TYPE_LEDGER = 'ledger';
    const ACCOUNT_TYPE_BUDGET = 'budget';

    const PAYMENT_TYPE_REGULAR = 'regular';
    const PAYMENT_TYPE_ONE_OFF = 'one-off';

    const INTERVAL_ONCE = 'once';
    const INTERVAL_WEEKLY = 'weekly';
    const INTERVAL_MONTHLY = 'monthly';
    const INTERVAL_QUARTERLY = 'quarterly';
    const INTERVAL_YEARLY = 'yearly';

    const INTERVALS = [
        Payment::INTERVAL_WEEKLY,
        Payment::INTERVAL_MONTHLY,
        Payment::INTERVAL_QUARTERLY,
        Payment::INTERVAL_YEARLY,
    ];

    use HasFactory;

    protected $fillable = [
        'creator_id',
        'account_type',
        'payment_type',
        'shop_id',
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

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class)->withDefault([
            'title' => 'unknown'
        ]);
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

    public function isRegular()
    {
        return $this->payment_type === Payment::PAYMENT_TYPE_REGULAR;
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

    public function isYearly()
    {
        return $this->interval === self::INTERVAL_YEARLY;
    }

    public function isQuarterly()
    {
        return $this->interval === self::INTERVAL_QUARTERLY;
    }

    public function isMonthly()
    {
        return $this->interval === self::INTERVAL_MONTHLY;
    }

    public function isWeekly()
    {
        return $this->interval === self::INTERVAL_WEEKLY;
    }
}
