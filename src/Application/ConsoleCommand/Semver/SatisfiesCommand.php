<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function implode;
use function is_string;
use function sprintf;

class SatisfiesCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('semver:satisfies');
        $this->setDescription(implode('; ', [
            'Check if a Composer SemVer constraint satisfies a version',
            'exit code 0 is returned for a positive result, 1 for a negative result.',
        ]));
        $this->addArgument('constraint', InputArgument::REQUIRED, 'Composer SemVer constraint');
        $this->addArgument('version', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $constraint = $input->getArgument('constraint');
        if (!is_string($constraint)) {
            throw new UnexpectedValueException('the value of \'constraint\' should be a string');
        }
        $version = $input->getArgument('version');
        if (!is_string($version)) {
            throw new UnexpectedValueException('the value of \'version\' should be a string');
        }
        $result = Semver::satisfies($version, $constraint);
        if ($output->isVerbose()) {
            $output->writeln(sprintf(
                'Composer SemVer constraint \'%s\' %s version \'%s\'',
                $constraint,
                $result ? 'satisfies' : 'does not satisfy',
                $version
            ));
        }
        return $result ? 0 : 1;
    }
}
