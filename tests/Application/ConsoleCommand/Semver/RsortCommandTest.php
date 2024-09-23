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

#[CoversClass(RsortCommand::class)]
class RsortCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandTester = new CommandTester(new RsortCommand());
    }

    /**
     * @param array<string> $versions
     * @param array<string> $sorted
     * @param array<string> $rsorted
     */
    #[DataProviderExternal(SemverTest::class, 'sortProvider')]
    public function testExecute(array $versions, array $sorted, array $rsorted): void
    {
        $this->commandTester->execute(['version' => $versions]);
        static::assertSame(implode(PHP_EOL, $rsorted) . PHP_EOL, $this->commandTester->getDisplay());
    }
}
