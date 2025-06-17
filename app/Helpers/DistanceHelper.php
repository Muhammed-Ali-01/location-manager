<?php

namespace App\Helpers;

class DistanceHelper
{
    public static function calculate(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $r = 6371; // Earth's radius in kilometers
        $p = M_PI / 180;
    
        $a = 0.5 - cos(($lat2 - $lat1) * $p) / 2
            + cos($lat1 * $p) * cos($lat2 * $p) *
              (1 - cos(($lon2 - $lon1) * $p)) / 2;
    
        return 2 * $r * asin(sqrt($a));
    }
    
}

