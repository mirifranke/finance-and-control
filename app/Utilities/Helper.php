<?php

namespace App\Utilities;

use Illuminate\Support\Carbon;

class Helper
{

    public static function getCents(string $amount): int
    {
        $euroAndCent = explode(',', str_replace('.', ',', $amount));

        $cents = $euroAndCent[0] * 100;
        if (count($euroAndCent) > 1) {
            $cents += $euroAndCent[1];
        }

        return $cents;
    }

    public static function getCurrentMonth($date)
    {
        if (!$date) {
            return Carbon::now()->firstOfMonth();
        }

        return Carbon::createFromFormat('d-m-Y', $date);
    }

    public static function getLastMonth($currentDate)
    {
        return $currentDate->copy()->subMonth()->format('d-m-Y');
    }

    public static function getNextMonth($currentDate)
    {
        return $currentDate->copy()->addMonth()->format('d-m-Y');
    }
}
