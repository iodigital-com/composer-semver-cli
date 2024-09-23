<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\SemverTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

#[CoversClass(SatisfiesCommand::class)]
class SatisfiesCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandTester = new CommandTester(new SatisfiesCommand());
    }

    #[DataProviderExternal(SemverTest::class, 'satisfiesProvider')]
    public function testExecute(bool $expected, string $version, string $constraint): void
    {
        $this->commandTester->execute(['constraint' => $constraint, 'version' => $version]);
        static::assertSame($expected ? 0 : 1, $this->commandTester->getStatusCode());
    }
}
