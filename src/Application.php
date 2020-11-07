<?php

declare(strict_types=1);

namespace ComposerSemverCli;

use ComposerSemverCli\Application\ConsoleCommand\Comparator\EqualToCommand as ComparatorEqualToCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\GreaterThanCommand as ComparatorGreaterThanCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\GreaterThanOrEqualToCommand as ComparatorGreaterThanOrEqualToCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\LessThanCommand as ComparatorLessThanCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\LessThanOrEqualToCommand as ComparatorLessThanOrEqualToCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Comparator\NotEqualToCommand as ComparatorNotEqualToCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Semver\RsortCommand as SemverRsortCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SatisfiedByCommand as SemverSatisfiedByCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SatisfiesCommand as SemverSatisfiesCommandAlias;
use ComposerSemverCli\Application\ConsoleCommand\Semver\SortCommand as SemverSortCommandAlias;
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
            new ComparatorGreaterThanCommandAlias(),
            new ComparatorGreaterThanOrEqualToCommandAlias(),
            new ComparatorLessThanCommandAlias(),
            new ComparatorLessThanOrEqualToCommandAlias(),
            new ComparatorEqualToCommandAlias(),
            new ComparatorNotEqualToCommandAlias(),
            new SemverSatisfiesCommandAlias(),
            new SemverSatisfiedByCommandAlias(),
            new SemverSortCommandAlias(),
            new SemverRsortCommandAlias(),
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
