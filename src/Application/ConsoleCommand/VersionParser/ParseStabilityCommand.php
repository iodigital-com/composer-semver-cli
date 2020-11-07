<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\VersionParser;

use Composer\Semver\VersionParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function is_string;

class ParseStabilityCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('version-parser:parse-stability');
        $this->setDescription('Return stability of the supplied version');
        $this->addArgument('version', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $version = $input->getArgument('version');
        if (!is_string($version)) {
            throw new UnexpectedValueException('the value of \'version\' should be a string');
        }
        $stability = VersionParser::parseStability($version);
        $output->writeln($stability);
        return 0;
    }
}
