<?php

namespace App\Repository;

use App\Entity\Noun;

class NounRepository
{
    private array $nouns = [];

    public function __construct(array $nouns)
    {
        $this->nouns = $nouns;
    }

    public function findRandom(): Noun
    {
        return $this->nouns[
            array_rand($this->nouns)
        ];
    }
}
