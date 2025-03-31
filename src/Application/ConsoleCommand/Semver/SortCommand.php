<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\Semver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnexpectedValueException;

use function array_filter;
use function is_array;

class SortCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('semver:sort');
        $this->setDescription('Sort versions according to Composer SemVer.');
        $this->addArgument('version', InputArgument::IS_ARRAY, 'a list of versions');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $versions = $input->getArgument('version');
        if (!is_array($versions) || array_filter($versions, 'is_string') !== $versions) {
            throw new UnexpectedValueException('the value of \'version\' should be an array of strings');
        }
        $sortedVersions = Semver::sort($versions);
        $output->writeln($sortedVersions);
        return 0;
    }
}
