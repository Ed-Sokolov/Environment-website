<?php

namespace App\Helper;

class App
{
    static public function generateNumber(int $min, int $max): float
    {
        $randomNumber = rand($min * 100, $max * 100);
        return round($randomNumber / 100, 2);
    }
}
