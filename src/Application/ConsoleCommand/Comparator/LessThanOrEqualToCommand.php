<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Comparator;

use Composer\Semver\Comparator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function implode;
use function is_string;
use function sprintf;

class LessThanOrEqualToCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('comparator:lte');
        $this->setDescription(implode('; ', [
            'Check if version1 is less than or equal to version2 according to Composer SemVer',
            'exit code 0 is returned for a positive result, 1 for a negative result.',
        ]));
        $this->addArgument('version1', InputArgument::REQUIRED);
        $this->addArgument('version2', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $version1 = $input->getArgument('version1');
        if (!is_string($version1)) {
            throw new UnexpectedValueException('the value of \'version1\' should be a string');
        }
        $version2 = $input->getArgument('version2');
        if (!is_string($version2)) {
            throw new UnexpectedValueException('the value of \'version2\' should be a string');
        }
        $result = Comparator::lessThanOrEqualTo($version1, $version2);
        if ($output->isVerbose()) {
            $output->writeln(sprintf(
                'version \'%s\' %s less than or equal to version \'%s\' according to Composer SemVer',
                $version1,
                $result ? 'is' : 'is not',
                $version2
            ));
        }
        return $result ? 0 : 1;
    }
}
