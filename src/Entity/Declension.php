<?php

namespace App\Entity;

class Declension
{
    private DeclensionCase $nominative;
    private DeclensionCase $genitive;
    private DeclensionCase $dative;
    private DeclensionCase $accusative;
    private DeclensionCase $instrumental;
    private DeclensionCase $prepositional;

    public function __construct(
        DeclensionCase $nominative,
        DeclensionCase $genitive,
        DeclensionCase $dative,
        DeclensionCase $accusative,
        DeclensionCase $instrumental,
        DeclensionCase $prepositional
    ) {
        $this->nominative = $nominative;
        $this->genitive = $genitive;
        $this->dative = $dative;
        $this->accusative = $accusative;
        $this->instrumental = $instrumental;
        $this->prepositional = $prepositional;
    }

    public function getAllCases(): array
    {
        return [
            $this->nominative,
            $this->genitive,
            $this->dative,
            $this->accusative,
            $this->instrumental,
            $this->prepositional,
        ];
    }

    public function getNominative(): DeclensionCase
    {
        return $this->nominative;
    }

    public function getGenitive(): DeclensionCase
    {
        return $this->genitive;
    }

    public function getDative(): DeclensionCase
    {
        return $this->dative;
    }

    public function getAccusative(): DeclensionCase
    {
        return $this->accusative;
    }

    public function getInstrumental(): DeclensionCase
    {
        return $this->instrumental;
    }

    public function getPrepositional(): DeclensionCase
    {
        return $this->prepositional;
    }
}
