<?php

namespace App;

use App\Entity\Gender;

class GenderGuesser
{
    public function guessNoun(string $noun): Gender
    {
        if (preg_match('/(о|е|ё)$/i', $noun)) {
            return Gender::neuter();
        } else if (preg_match('/(а|я)$/i', $noun)) {
            return Gender::feminine();
        } else {
            return Gender::masculine();
        }
    }
}
