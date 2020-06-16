<?php

namespace App\Import\Badestrand;

use League\Csv\Reader;

class Importer
{
    public function __construct(NounImporter $nounImporter)
    {
        $this->nounImporter = $nounImporter;
    }

    public function import(string $path): array
    {
        $reader = Reader::createFromPath($path);
        $reader->setHeaderOffset(0);
        $reader->setDelimiter("\t");

        $nouns = [];

        foreach ($reader->getRecords() as $record) {
            $nouns[] = $this->nounImporter->import($record);
        }

        return $nouns;
    }
}
