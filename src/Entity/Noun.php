<?php

namespace App\Entity;

class Noun
{
    private string $bare;
    private string $stressed;
    private ?Declension $singular;
    private ?Declension $plural;
    private string $definition;
    private Gender $gender;

    public function __construct(
        string $bare,
        string $stressed,
        ?Declension $singular,
        ?Declension $plural,
        string $definition,
        Gender $gender
    ) {
        $this->bare = $bare;
        $this->stressed = $stressed;
        $this->singular = $singular;
        $this->plural = $plural;
        $this->definition = $definition;
        $this->gender = $gender;
    }

    public function getBare(): string
    {
        return $this->bare;
    }

    public function getStressed(): string
    {
        return $this->stressed;
    }

    public function getDefinition(): string
    {
        return $this->definition;
    }

    public function getSingularDeclension(): ?Declension
    {
        return $this->singular;
    }

    public function getPluralDeclension(): ?Declension
    {
        return $this->plural;
    }
}
