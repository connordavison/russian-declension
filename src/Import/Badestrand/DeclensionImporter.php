<?php

namespace App\Import\Badestrand;

use App\Entity\Declension;
use App\Entity\DeclensionCase;
use App\Entity\Noun;

class DeclensionImporter
{
    public function importSingular(array $row): Declension
    {
        return new Declension(
            DeclensionCase::nominative($row['sg_nom']),
            DeclensionCase::genitive($row['sg_gen']),
            DeclensionCase::dative($row['sg_dat']),
            DeclensionCase::accusative($row['sg_acc']),
            DeclensionCase::instrumental($row['sg_inst']),
            DeclensionCase::prepositional($row['sg_prep'])
        );
    }

    public function importPlural(array $row): Declension
    {
        return new Declension(
            DeclensionCase::nominative($row['pl_nom']),
            DeclensionCase::genitive($row['pl_gen']),
            DeclensionCase::dative($row['pl_dat']),
            DeclensionCase::accusative($row['pl_acc']),
            DeclensionCase::instrumental($row['pl_inst']),
            DeclensionCase::prepositional($row['pl_prep'])
        );
    }

    public function importIndeclinable(array $row): Declension
    {
        return new Declension(
            DeclensionCase::nominative($row['accented']),
            DeclensionCase::genitive($row['accented']),
            DeclensionCase::dative($row['accented']),
            DeclensionCase::accusative($row['accented']),
            DeclensionCase::instrumental($row['accented']),
            DeclensionCase::prepositional($row['accented'])
        );
    }
}
