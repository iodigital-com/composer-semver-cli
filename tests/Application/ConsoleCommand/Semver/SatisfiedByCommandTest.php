<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Semver;

use Composer\Semver\SemverTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

use function implode;

use const PHP_EOL;

#[CoversClass(SatisfiedByCommand::class)]
class SatisfiedByCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandTester = new CommandTester(new SatisfiedByCommand());
    }

    /**
     * @param array<string> $versions
     * @param array<string> $expected
     */
    #[DataProviderExternal(SemverTest::class, 'satisfiedByProvider')]
    public function testExecute(string $constraint, array $versions, array $expected): void
    {
        $this->commandTester->execute(['constraint' => $constraint, 'version' => $versions]);
        static::assertSame(implode(PHP_EOL, $expected) . PHP_EOL, $this->commandTester->getDisplay());
    }
}
