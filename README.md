Composer SemVer CLI
===================

A CLI wrapper around the [composer/semver](https://github.com/composer/semver) package.
Two command namespaces are added for representing the [`Composer\Semver\Comparator`](https://github.com/composer/semver#comparator) and [`Composer\Semver\Semver`](https://github.com/composer/semver#semver) classes.

Installation
------------

Add the package as a requirement to your project:

    $ composer require isaac/composer-semver-cli

This will install the `composer-semver` script to the `vendor/bin` folder of the project.

Or as a global requirement:

    $ composer global require isaac/composer-semver-cli

This will install the `composer-semver` script to the `$HOME/.composer/vendor/bin` folder.

Usage
-----

The following commands are provided:

* `comparator:qt`: indicates whether `version1` is greater than `version2` according to Composer SemVer
* `comparator:gte`: indicates whether `version1` is greater than or equal to `version2` according to Composer SemVer
* `comparator:lt`: indicates whether `version1` is less than `version2` according to Composer SemVer
* `comparator:lte`: indicates whether `version1` is less than or equal to `version2` according to Composer SemVer
* `comparator:eq`:  indicates whether `version1` is equal to `version2` according to Composer SemVer
* `comparator:neq`:  indicates whether `version1` is not equal to `version2` according to Composer SemVer
* `semver:satisfies`: check if a Composer SemVer constraint satisfies a version
* `semver:satisfied-by`: list which of the supplied versions are satisfied by a Composer SemVer constraint
* `semver:sort`: sort versions according to Composer SemVer
* `semver:rsort`: reverse sort versions according to Composer SemVer

Examples
--------

Check whether a version is greater than another version:

    $ composer-semver -v comparator:gt '1.25.0' '1.24.0'
    version '1.25.0' is greater than version '1.24.0' according to SemVer

Sort versions:

    $ composer-semver semver:sort '1.25.0' '1.24.0' '1.25.0-rc1' '1.25.0-p1'
    1.24.0
    1.25.0-rc1
    1.25.0
    1.25.0-p1

Check is a version is satisfied by Composer SemVer constraint:

    $ composer-semver semver:satisfies -v '^1.25' '1.25.0-rc1'
    SemVer constraint '^1.25' satisfies version '1.25.0-rc1'

Check which versions are satisfied by a Composer SemVer constraint:

    $ composer-semver semver:satisfied-by '^1.25' '1.24.0' 1.25.0-rc1 '1.25.0' '1.25.0-p1' '1.26.0' '2.0.0'
    1.25.0-rc1
    1.25.0
    1.25.0-p1
    1.26.0

Applications
------------

This tool allows for Composer SemVer calculations where using the Composer tool itself would be impractical.

For instance, to prepare for a PHP upgrade, it is nice to know upfront if the new version introduces any incompatibilities with the `require.php` property of the packages in the `vendor` folder. The following command generates a list of packages that are incompatible with PHP 7.4.0:

    $ for f in vendor/*/*/composer.json ; do if jq -e '.require.php' $f > /dev/null && ! composer-semver semver:satisfies "$(jq -r '.require.php' $f)" '7.4.0' ; then echo $f ; fi ; done

Note that the Composer tool can also provide this information, but this is only for one package at a time. In order to get the next incompatible package, the incompatibility in the first package needs to be resolved.


As another application, you might want to check how Composer sees the git tags of you application. For instance, you can sort them according to Composer SemVer:

    git tag -l | xargs composer-semver semver:sort

Or check which tags satisfy a Composer SemVer constraint:

    git tag -l | xargs composer-semver semver:satisfied-by "^v1.2"
