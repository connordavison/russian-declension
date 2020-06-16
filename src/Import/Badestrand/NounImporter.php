<?php

namespace App\Import\Badestrand;

use App\Entity\Declension;
use App\Entity\Gender;
use App\Entity\Noun;
use App\GenderGuesser;

class NounImporter
{
    private $declensionImporter;
    private $genderGuesser;

    public function __construct(
        DeclensionImporter $declensionImporter,
        GenderGuesser $genderGuesser
    ) {
        $this->declensionImporter = $declensionImporter;
        $this->genderGuesser = $genderGuesser;
    }

    public function import(array $row)
    {
        return new Noun(
            $row['bare'],
            $row['accented'],
            $this->createSingularDeclension($row),
            $this->createPluralDeclension($row),
            $row['translations_en'],
            $this->getGender($row['bare'], $row['gender'])
        );
    }

    private function createSingularDeclension(array $row): ?Declension
    {
        if ($row['pl_only']) {
            return null;
        }

        if ($row['indeclinable']) {
            return $this->declensionImporter->importIndeclinable($row);
        }

        return $this->declensionImporter->importSingular($row);
    }

    private function createPluralDeclension(array $row): ?Declension
    {
        if ($row['sg_only']) {
            return null;
        }

        if ($row['indeclinable']) {
            return $this->declensionImporter->importIndeclinable($row);
        }

        return $this->declensionImporter->importPlural($row);
    }

    private function getGender(string $bare, string $gender): Gender
    {
        switch ($gender) {
            case 'm': return Gender::masculine();
            case 'f': return Gender::feminine();
            case 'n': return Gender::neuter();
        }

        return $this->genderGuesser->guessNoun($bare);
    }
}
