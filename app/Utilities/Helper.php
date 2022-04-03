<?php

namespace App\Utilities;

use Illuminate\Support\Carbon;

class Helper
{
    public static function getCents(string $amount, bool $isDebit): int
    {
        $euroAndCent = explode(',', str_replace('.', ',', $amount));

        $cents = $euroAndCent[0] * 100;
        if (count($euroAndCent) > 1) {
            if (strlen($euroAndCent[1]) == 1) {
                $cents += $euroAndCent[1] * 10;
            } else if (strlen($euroAndCent[1]) == 2) {
                $cents += $euroAndCent[1];
            }
        }

        if ($isDebit) {
            $cents = $cents * (-1);
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
