<?php

declare(strict_types=1);

namespace ComposerSemverCli\Application;

use function fgets;
use function file_exists;
use function fopen;
use function trim;

class VersionHelper
{
    protected const UNKNOWN_VERSION = 'unknown';

    public function getVersion(): string
    {
        $firstLine = trim($this->getFirstLine($this->getVersionFilePath()));
        if ($firstLine !== '') {
            return $firstLine;
        }
        return self::UNKNOWN_VERSION;
    }

    protected function getVersionFilePath(): string
    {
        return __DIR__ . '/../../version.txt';
    }

    protected function getFirstLine(string $filePath): string
    {
        if (!file_exists($filePath)) {
            return '';
        }
        $fileHandle = fopen($filePath, 'rb');
        if ($fileHandle === false) {
            return '';
        }
        $firstLine = fgets($fileHandle);
        if ($firstLine === false) {
            return '';
        }
        return $firstLine;
    }
}
