<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'composer/package-versions-deprecated' => '1.11.99.5@b4f54f74ef3453349c24a845d22392cd31e65f1d',
  'doctrine/annotations' => '1.13.2@5b668aef16090008790395c02c893b1ba13f7e08',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/collections' => '1.6.8@1958a744696c6bb3bb0d28db2611dc11610e78af',
  'doctrine/common' => '3.2.2@295082d3750987065912816a9d536c2df735f637',
  'doctrine/dbal' => '2.13.8@dc9b3c3c8592c935a6e590441f9abc0f9eba335b',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/doctrine-bundle' => '2.6.0@eca20633225fde77d042ecdac222bc9a5cb20f6a',
  'doctrine/doctrine-migrations-bundle' => '3.2.2@3393f411ba25ade21969c33f2053220044854d01',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/inflector' => '2.0.4@8b7ff3e4b7de6b2c84da85637b59fd2880ecaa89',
  'doctrine/instantiator' => '1.4.1@10dcfce151b967d20fde1b34ae6640712c3891bc',
  'doctrine/lexer' => '1.2.3@c268e882d4dbdd85e36e4ad69e02dc284f89d229',
  'doctrine/migrations' => '3.3.2@b6e43bb5815f4dbb88c79a0fef1c669dfba52d58',
  'doctrine/orm' => '2.10.5@1e972b6e0e3468355901a301735d859165490af2',
  'doctrine/persistence' => '2.4.1@092a52b71410ac1795287bb5135704ef07d18dd0',
  'doctrine/sql-formatter' => '1.1.2@20c39c2de286a9d3262cc8ed282a4ae60e265894',
  'firebase/php-jwt' => 'v6.1.0@fbb2967a3a68b07e37678c00c0cf51165051495f',
  'friendsofphp/proxy-manager-lts' => 'v1.0.7@c828ced1f932094ab79e4120a106a666565e4d9c',
  'laminas/laminas-code' => '4.5.1@6fd96d4d913571a2cd056a27b123fa28cb90ac4e',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.1.2@513e0666f7216c7459170d56df27dfcefe1689ea',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'sensio/framework-extra-bundle' => 'v6.2.6@6bd976c99ef3f78e31c9490a10ba6dd8901076eb',
  'symfony/cache' => 'v5.4.6@c0718d0e01ac14251a45cc9c8b93716ec41ae64b',
  'symfony/cache-contracts' => 'v2.5.0@ac2e168102a2e06a2624f0379bde94cd5854ced2',
  'symfony/config' => 'v5.4.3@d65e1bd990c740e31feb07d2b0927b8d4df9956f',
  'symfony/console' => 'v5.4.5@d8111acc99876953f52fe16d4c50eb60940d49ad',
  'symfony/dependency-injection' => 'v5.4.6@0828fa3e6e436243dbb3dc85abe6b698b3876b89',
  'symfony/deprecation-contracts' => 'v2.5.0@6f981ee24cf69ee7ce9736146d1c57c2780598a8',
  'symfony/doctrine-bridge' => 'v5.4.6@ca55e1f888b7e5b358736bb6c8e33482939993cc',
  'symfony/dotenv' => 'v5.4.5@83a2310904a4f5d4f42526227b5a578ac82232a9',
  'symfony/error-handler' => 'v5.4.3@c4ffc2cd919950d13c8c9ce32a70c70214c3ffc5',
  'symfony/event-dispatcher' => 'v5.4.3@dec8a9f58d20df252b9cd89f1c6c1530f747685d',
  'symfony/event-dispatcher-contracts' => 'v2.5.0@66bea3b09be61613cd3b4043a65a8ec48cfa6d2a',
  'symfony/filesystem' => 'v5.4.6@d53a45039974952af7f7ebc461ccdd4295e29440',
  'symfony/finder' => 'v5.4.3@231313534dded84c7ecaa79d14bc5da4ccb69b7d',
  'symfony/flex' => 'v1.18.5@10e438f53a972439675dc720706f0cd5c0ed94f1',
  'symfony/framework-bundle' => 'v5.4.6@76ea755f30924924ea37a28e098df61679efcb63',
  'symfony/http-foundation' => 'v5.4.6@34e89bc147633c0f9dd6caaaf56da3b806a21465',
  'symfony/http-kernel' => 'v5.4.6@d41f29ae9af1b5f40c7ebcddf09082953229411d',
  'symfony/password-hasher' => 'v5.4.3@b5ed59c4536d8386cd37bb86df2b7bd5fbbd46d4',
  'symfony/polyfill-intl-grapheme' => 'v1.25.0@81b86b50cf841a64252b439e738e97f4a34e2783',
  'symfony/polyfill-intl-normalizer' => 'v1.25.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.25.0@0abb51d2f102e00a4eefcf46ba7fec406d245825',
  'symfony/polyfill-php73' => 'v1.25.0@cc5db0e22b3cb4111010e48785a97f670b350ca5',
  'symfony/polyfill-php80' => 'v1.25.0@4407588e0d3f1f52efb65fbe92babe41f37fe50c',
  'symfony/polyfill-php81' => 'v1.25.0@5de4ba2d41b15f9bd0e19b2ab9674135813ec98f',
  'symfony/proxy-manager-bridge' => 'v5.4.6@e6936de1cc8f4e6e3b2264aef186ca21695aee8e',
  'symfony/routing' => 'v5.4.3@44b29c7a94e867ccde1da604792f11a469958981',
  'symfony/runtime' => 'v5.4.5@06fdd940ebf240ed7d9c9832cd97bf3133847316',
  'symfony/service-contracts' => 'v2.5.0@1ab11b933cd6bc5464b08e81e2c5b07dec58b0fc',
  'symfony/stopwatch' => 'v5.4.5@4d04b5c24f3c9a1a168a131f6cbe297155bc0d30',
  'symfony/string' => 'v5.4.3@92043b7d8383e48104e411bc9434b260dbeb5a10',
  'symfony/var-dumper' => 'v5.4.6@294e9da6e2e0dd404e983daa5aa74253d92c05d0',
  'symfony/var-exporter' => 'v5.4.6@49e2355fe6f59ea30c18ebb68edf13b7e20582e5',
  'symfony/yaml' => 'v5.4.3@e80f87d2c9495966768310fc531b487ce64237a2',
  'doctrine/data-fixtures' => '1.5.2@51c1890e8c5467c421c7cab4579f059ebf720278',
  'doctrine/doctrine-fixtures-bundle' => '3.4.1@31ba202bebce0b66fe830f49f96228dcdc1503e7',
  'nikic/php-parser' => 'v4.13.2@210577fe3cf7badcc5814d99455df46564f3c077',
  'symfony/maker-bundle' => 'v1.38.0@143024ab0e426285d3d9b7f6a3ce51e12a9d8ec5',
  'symfony/polyfill-ctype' => '*@d7a02565982e683146100e7812054e9a7686a672',
  'symfony/polyfill-iconv' => '*@d7a02565982e683146100e7812054e9a7686a672',
  'symfony/polyfill-php72' => '*@d7a02565982e683146100e7812054e9a7686a672',
  '__root__' => 'dev-aziz@d7a02565982e683146100e7812054e9a7686a672',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
