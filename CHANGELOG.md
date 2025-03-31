# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## Unreleased

## [v1.5.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.5.0) - 2025-04-01

### Added

- Add PHP 8.4 support
- Add GitHub workflow for running PHP_CodeSniffer and PHPStan
- Add `catalog-info.yaml`

### Changed

- Update `composer/semver` dependency (3.4.2 => 3.4.3)
- Update `symfony/console` dependency (v6.4.9 => v6.4.20)
- Update `phpstan/phpstan` dependency (1.11.7 => 2.1.11)
- Update `phpstan/extension-installer` dependency (1.4.1 => 1.4.3)
- Update `phpstan/phpstan-strict-rules` dependency (1.6.0 => 2.0.4)
- Update `iodigital-com/php-code-sniffer-standard` dependency (v29.2.0 => v29.3.0)

## [v1.4.2](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.4.2) - 2024-07-12

### Changed

- Update `composer/semver` dependency (3.4.1 => 3.4.2)

## [v1.4.1](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.4.1) - 2024-07-12

### Changed

- Update `composer/semver` dependency (3.4.0 => 3.4.1)
- Update `phpstan/phpstan` dependency (1.11.5 => 1.11.7)
- Update `composer.json` SemVer constraints to match the versions in `composer.lock`

## [v1.4.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.4.0) - 2024-07-01

### Changed

- Rename package from `isaac/composer-semver-cli` to `iodigital-com/composer-semver-cli`

## [v1.3.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.3.0) - 2024-07-01

### Changed

- Update `composer/semver` dependency (3.2.4 => 3.4.0)
- Update `symfony/console` dependency (v5.2.6 => v6.4.9)
- Replace `isaac/php-code-sniffer-standard` (v21.0.0) by `iodigital-com/php-code-sniffer-standard` (v29.2.0)
- Update `phpstan/phpstan` dependency (0.12.85 => 1.11.5)
- Update Copyright year
- Change Copyright name from ISAAC to iO

### Removed

- Drop support for PHP 7.x and 8.0

## [v1.2.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.2.0) - 2021-04-30

### Added

- Add `phpstan/phpstan-strict-rules` and `phpstan/extension-installer` packages

### Changed

- Update `composer/semver` dependency from 3.2.2 to 3.2.4
- Update `symfony/console` dependency from v5.1.8 to v5.2.6
- Update `isaac/php-code-sniffer-standard` dependency from v19.0.0 to v21.0.0
- Update `phpstan/phpstan` dependency from 0.12.53 to 0.12.85
- Switch to Composer 2 (Composer 1 still works)
- Update Copyright year

## [v1.1.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.1.0) - 2020-11-07

### Added

- Add `version-parser:parse-stability` command

## [v1.0.1](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.0.1) - 2020-11-06

### Fixed

- Compatibility with PHP 7.2 and 7.3 for development by downgrading object-calisthenics/phpcs-calisthenics-rules from 3.9.1 to 3.8.0
- Improve examples and applications in the README

## [v1.0.0](https://github.com/iodigital-com/composer-semver-cli/releases/tag/v1.0.0) - 2020-11-01

### Added

- First version of the composer-semver tool
