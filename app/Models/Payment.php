<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    const TYPE_REGULAR = 'regular';
    const TYPE_ONE_OFF = 'one-off';

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
    use Uuids;

    protected $fillable = [

    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
