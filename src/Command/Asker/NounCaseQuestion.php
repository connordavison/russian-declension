<?php

namespace App\Command\Asker;

use App\Entity\DeclensionCase;
use App\Entity\Noun;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class NounCaseQuestion
{
    private Noun $noun;
    private DeclensionCase $case;
    private string $plurality;

    public function __construct(Noun $noun, DeclensionCase $case, string $plurality)
    {
        $this->noun = $noun;
        $this->case = $case;
        $this->plurality = $plurality;
    }

    public function getConfirmationQuestion(): Question
    {
        return new ConfirmationQuestion(
            $this->getMessage(),
            false,
            sprintf('/^%s$/i', $this->case->getBare())
        );
    }

    public function getCase(): DeclensionCase
    {
        return $this->case;
    }

    public function getMessage(): string
    {
        return sprintf(
            'What is the %s %s of %s?%sDefinition: %s%s',
            $this->plurality,
            $this->case->getName(),
            $this->noun->getBare(),
            PHP_EOL,
            $this->noun->getDefinition() ?? '~',
            PHP_EOL
        );
    }
}
