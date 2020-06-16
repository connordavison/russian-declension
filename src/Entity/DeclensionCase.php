<?php

namespace App\Entity;

class DeclensionCase
{
    private string $name;
    private string $stressed;
    private string $bare;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->stressed = $value;
        $this->bare = preg_replace('/\'|\*/', '', $value);
    }

    public static function nominative(string $value): self
    {
        return new self('nominative', $value);
    }

    public static function genitive(string $value): self
    {
        return new self('genitive', $value);
    }

    public static function dative(string $value): self
    {
        return new self('dative', $value);
    }

    public static function instrumental(string $value): self
    {
        return new self('instrumental', $value);
    }

    public static function accusative(string $value): self
    {
        return new self('accusative', $value);
    }

    public static function prepositional(string $value): self
    {
        return new self('prepositional', $value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBare(): string
    {
        return $this->bare;
    }
}
