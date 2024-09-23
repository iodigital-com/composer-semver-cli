<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application\ConsoleCommand\Comparator;

use Composer\Semver\ComparatorTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

#[CoversClass(GreaterThanCommand::class)]
class GreaterThanOrEqualCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandTester = new CommandTester(new GreaterThanOrEqualToCommand());
    }

    #[DataProviderExternal(ComparatorTest::class, 'greaterThanOrEqualToProvider')]
    public function testExecute(string $version1, string $version2, bool $expected): void
    {
        $this->commandTester->execute(['version1' => $version1, 'version2' => $version2]);
        static::assertSame($expected ? 0 : 1, $this->commandTester->getStatusCode());
    }
}
