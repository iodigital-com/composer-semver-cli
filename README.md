Composer SemVer CLI
===================

A CLI wrapper around the [composer/semver](https://github.com/composer/semver) package.
Command namespaces are added for representing most methods of the [`Composer\Semver\Comparator`](https://github.com/composer/semver#comparator), [`Composer\Semver\Semver`](https://github.com/composer/semver#semver) and `Composer\Semver\VersionParser` classes.

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
* `version-parser:parse-stability`: return stability of the supplied version

Examples
--------

Check whether a version is greater than another version:

    $ composer-semver -v comparator:gt '1.25.0-alpha1' 'v1.24.0-p1'
    version '1.25.0-alpha1' is greater than version 'v1.24.0-p1' according to Composer SemVer

Sort versions:

    $ composer-semver semver:sort '1.25.0' 'v1.25.0-p2' '1.25.0-rc3' 'v1.25-dev'
    v1.25-dev
    1.25.0-rc3
    1.25.0
    v1.25.0-p2

Check if a version is satisfied by a Composer SemVer constraint:

    $ composer-semver semver:satisfies -v '^1.25.0-p1' 'v1.25-p2'
    Composer SemVer constraint '^1.25.0-p1' satisfies version 'v1.25-p2'

Check which versions are satisfied by a Composer SemVer constraint:

    $ composer-semver semver:satisfied-by '^1.25.0-p1' '1.25.0' 'v1.25.0-p2' '1.25.0-rc3' 'v1.25-dev'
    v1.25.0-p2

Return stability of a version:

    $ composer-semver version-parser:parse-stability '1.25.0-rc3'
    RC

Applications
------------

This tool allows for Composer SemVer calculations where using the Composer tool itself would be impractical.

For instance, to prepare for a PHP upgrade, it is nice to know upfront if the new version introduces any incompatibilities with the `require.php` property of the packages in the `vendor` folder. This can be done using the `check-platform-reqs` Composer command; however, this the Composer command is actually run in the context of the new PHP version. When this is not possible, the following command can be used to  generate a list of packages that are incompatible with a specific PHP version (in this case 8.3.0):

    $ for f in vendor/*/*/composer.json ; do if jq -e '.require.php' $f > /dev/null && ! composer-semver semver:satisfies "$(jq -r '.require.php' $f)" '8.3.0' ; then echo $f ; fi ; done

Note that this makes use of the [jq](https://stedolan.github.io/jq/) command.


As another application, you might want to check how Composer sees the git tags of your application. For instance, you can sort them according to Composer SemVer:

    $ composer-semver semver:sort $(git tag -l)

Or check which tags satisfy a Composer SemVer constraint:

    $ composer-semver semver:satisfied-by "^1.2" $(git tag -l)

Or you might want to know how many stable versions have been released:

    $ for VERSION in $(git tag -l) ; do composer-semver version-parser:parse-stability ${VERSION} ; done | grep -c "stable"
