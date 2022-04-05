<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const TYPE_REGULAR = 'regular';
    const TYPE_ONE_OFF = 'one-off';

    const INTERVAL_ONCE = 'once';
    const INTERVAL_DAILY = 'daily';
    const INTERVAL_WEEKLY = 'weekly';
    const INTERVAL_MONTHLY = 'monthly';
    const INTERVAL_QUARTERLY = 'quarterly';
    const INTERVAL_HALF_YEARLY = 'half-yearly';
    const INTERVAL_YEARLY = 'yearly';

    const INTERVALS = [
        Payment::INTERVAL_DAILY,
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
        'title' => 'encrypted',
        'amount' => 'integer',
        'description' => 'encrypted',
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

    public function getAmountForUser()
    {
        return number_format($this->amount / 100, 2, ',', '.') . ' €';
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
    }
}
