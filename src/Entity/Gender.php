<?php

namespace App\Entity;

class Gender
{
    private const MASCULINE = 'MASCULINE';
    private const FEMININE = 'FEMININE';
    private const NEUTER = 'NEUTER';

    private string $type;

    private function __construct(string $type)
    {
        $this->type = $type;
    }

    public static function masculine(): self
    {
        return new self(self::MASCULINE);
    }

    public static function feminine(): self
    {
        return new self(self::FEMININE);
    }

    public static function neuter(): self
    {
        return new self(self::NEUTER);
    }
}
