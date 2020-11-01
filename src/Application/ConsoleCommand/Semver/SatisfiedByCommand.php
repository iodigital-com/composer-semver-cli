<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function array_map;
use function count;
use function implode;
use function is_array;
use function is_string;
use function sprintf;

class SatisfiedByCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('semver:satisfied-by');
        $this->setDescription(implode('; ', [
            'List which of the supplied versions are satisfied by a Composer SemVer constraint',
            'exit code 0 is returned when all versions are satisfied by the constraint, and 1 otherwise.',
        ]));
        $this->addArgument('constraint', InputArgument::REQUIRED, 'Composer SemVer constraint');
        $this->addArgument('version', InputArgument::IS_ARRAY, 'a list of versions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $constraint = $input->getArgument('constraint');
        if (!is_string($constraint)) {
            throw new UnexpectedValueException('the value of \'constraint\' should be a string');
        }
        $versions = $input->getArgument('version');
        if (!is_array($versions)) {
            throw new UnexpectedValueException('the value of \'version\' should be an array');
        }
        $satisfiedVersions = Semver::satisfiedBy($versions, $constraint);
        if ($output->isVerbose()) {
            $output->writeln(sprintf(
                'Composer SemVer constraint \'%s\' satisfies %d (%s) out of %d supplied versions (%s)',
                $constraint,
                count($satisfiedVersions),
                implode(' ', $this->getQuotedValues($satisfiedVersions)),
                count($versions),
                implode(' ', $this->getQuotedValues($versions))
            ));
        }
        if (!$output->isQuiet()) {
            $output->writeln($satisfiedVersions);
        }
        return count($satisfiedVersions) === count($versions) ? 0 : 1;
    }

    /**
     * @param string[] $values
     * @return string[]
     */
    protected function getQuotedValues(array $values): array
    {
        return array_map(static function ($value) {
            return sprintf('\'%s\'', $value);
        }, $values);
    }
}
