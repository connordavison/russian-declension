<?php

namespace App\Command;

use App\Command\Asker\NounCaseAsker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GameCommand extends Command
{
    protected static $defaultName = 'app:game';

    private NounCaseAsker $asker;

    public function __construct(NounCaseAsker $asker)
    {
        parent::__construct();

        $this->asker = $asker;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $success = 0;
        $failure = 0;

        while (true) {
            if ($this->asker->ask($this->getHelper('question'), $input, $output)) {
                $success++;
            } else {
                $failure++;
            }

            $output->writeln(sprintf('%sSuccess: %d; failure: %d%s%s', PHP_EOL, $success, $failure, PHP_EOL, PHP_EOL));
        }

        return 255;
    }
}
