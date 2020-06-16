<?php

namespace App\Command\Asker;

use App\Dice;
use App\Entity\Declension;
use App\Entity\Noun;
use App\Repository\NounRepository;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class NounCaseAsker
{
    private $nounRepository;
    private $dice;

    public function __construct(NounRepository $nounRepository, Dice $dice)
    {
        $this->nounRepository = $nounRepository;
        $this->dice = $dice;
    }

    public function ask(QuestionHelper $asker, InputInterface $input, OutputInterface $output): bool
    {
        $noun = $this->nounRepository->findRandom();
        $nounCaseQuestion = $this->createQuestion($noun);
        $case = $nounCaseQuestion->getCase();

        if ($asker->ask($input, $output, $nounCaseQuestion->getConfirmationQuestion())) {
            $output->writeln('Correct!');

            return true;
        }

        $output->writeln(
            sprintf(
                'Incorrect! Correct answer was: %s',
                $case->getBare()
            )
        );

        return false;
    }

    public function createQuestion(Noun $noun): NounCaseQuestion
    {
        $possibleQuestionFactories = [];
        $bare = $noun->getBare();
        $singularDeclension = $noun->getSingularDeclension();
        $pluralDeclension = $noun->getPluralDeclension();

        if ($singularDeclension) {
            $possibleQuestionFactories[] = fn () => $this->createDeclensionQuestion(
                $noun,
                $singularDeclension,
                'singular'
            );
        }

        if ($pluralDeclension) {
            $possibleQuestionFactories[] = fn () => $this->createDeclensionQuestion(
                $noun,
                $pluralDeclension,
                'plural'
            );
        }

        return $this->dice->roll($possibleQuestionFactories)();
    }

    public function createDeclensionQuestion(
        Noun $noun,
        Declension $declension,
        string $plurality
    ): NounCaseQuestion {
        $case = $this->dice->roll($declension->getAllCases());

        return new NounCaseQuestion($noun, $case, $plurality);
    }
}
