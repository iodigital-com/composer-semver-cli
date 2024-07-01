# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

- Updated `composer/semver` dependency (3.2.4 => 3.4.0)
- Updated `symfony/console` dependency (v5.2.6 => v6.4.9)
- Replaced `isaac/php-code-sniffer-standard` (v21.0.0) by `iodigital-com/php-code-sniffer-standard` (v29.2.0)
- Updated `phpstan/phpstan` dependency (0.12.85 => 1.11.5)
- Updated Copyright year
- Change Copyright name from ISAAC to iO

### Removed

- Dropped support for PHP 7.x and 8.0

## [v1.2.0] - 2021-04-30

### Added

- Added `phpstan/phpstan-strict-rules` and `phpstan/extension-installer` packages

### Changed

- Updated `composer/semver` dependency from 3.2.2 to 3.2.4
- Updated `symfony/console` dependency from v5.1.8 to v5.2.6
- Updated `isaac/php-code-sniffer-standard` dependency from v19.0.0 to v21.0.0
- Updated `phpstan/phpstan` dependency from 0.12.53 to 0.12.85
- Switched to Composer 2 (Composer 1 still works)
- Updated Copyright year

## [v1.1.0] - 2020-11-07

### Added

- Added `version-parser:parse-stability` command

## [v1.0.1] - 2020-11-06

### Fixed

- Compatibility with PHP 7.2 and 7.3 for development by downgrading object-calisthenics/phpcs-calisthenics-rules from 3.9.1 to 3.8.0
- Improve examples and applications in the README

## [v1.0.0] - 2020-11-01

### Added

- First version of the composer-semver tool
