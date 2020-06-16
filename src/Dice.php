<?php

namespace App;

class Dice
{
    public function roll($cases)
    {
        return $cases[
            floor($this->rand() * count($cases))
        ];
    }

    private function rand(): float
    {
        return mt_rand() / mt_getrandmax();
    }
}
