<?php

declare(strict_types=1);

namespace ComposerSemverCli;

use ComposerSemverCli\Application\ConsoleCommand\Comparator\EqualToCommand as ComparatorEqualToCommand;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\GreaterThanCommand as ComparatorGreaterThanCommand;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\GreaterThanOrEqualToCommand as ComparatorGreaterThanOrEqualToCommand;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\LessThanCommand as ComparatorLessThanCommand;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\LessThanOrEqualToCommand as ComparatorLessThanOrEqualToCommand;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\NotEqualToCommand as ComparatorNotEqualToCommand;
use ComposerSemverCli\Application\ConsoleCommand\Semver\RsortCommand as SemverRsortCommand;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SatisfiedByCommand as SemverSatisfiedByCommand;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SatisfiesCommand as SemverSatisfiesCommand;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SortCommand as SemverSortCommand;
use ComposerSemverCli\Application\ConsoleCommand\VersionParser\ParseStabilityCommand as VersionParserParseStabilityCommand;
use ComposerSemverCli\Application\VersionHelper;
use Exception;
use Symfony\Component\Console\Application as ConsoleApplication;

use function fwrite;

use const STDERR;

class Application
{
    /** @var ConsoleApplication */
    protected $consoleApplication;

    public function __construct(string $applicationName)
    {
        $versionHelper = new VersionHelper();
        $consoleApplication = new ConsoleApplication($applicationName, $versionHelper->getVersion());
        $consoleApplication->addCommands([
            new ComparatorGreaterThanCommand(),
            new ComparatorGreaterThanOrEqualToCommand(),
            new ComparatorLessThanCommand(),
            new ComparatorLessThanOrEqualToCommand(),
            new ComparatorEqualToCommand(),
            new ComparatorNotEqualToCommand(),
            new SemverSatisfiesCommand(),
            new SemverSatisfiedByCommand(),
            new SemverSortCommand(),
            new SemverRsortCommand(),
            new VersionParserParseStabilityCommand(),
        ]);
        $this->consoleApplication = $consoleApplication;
    }

    public function run(): int
    {
        try {
            return $this->consoleApplication->run();
        } catch (Exception $exception) {
            fwrite(STDERR, $exception->getMessage() . "\n");
            return 2;
        }
    }
}
