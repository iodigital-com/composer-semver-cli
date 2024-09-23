<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\VersionParser;

use Composer\Semver\VersionParserTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

use const PHP_EOL;

#[CoversClass(ParseStabilityCommand::class)]
class ParseStabilityCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandTester = new CommandTester(new ParseStabilityCommand());
    }

    #[DataProviderExternal(VersionParserTest::class, 'stabilityProvider')]
    public function testExecute(string $expected, string $version): void
    {
        $this->commandTester->execute(['version' => $version]);
        static::assertSame($expected . PHP_EOL, $this->commandTester->getDisplay());
    }
}
