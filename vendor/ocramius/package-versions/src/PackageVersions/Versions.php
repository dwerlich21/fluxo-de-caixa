<?php

declare(strict_types=1);

namespace PackageVersions;

use OutOfBoundsException;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = '__root__';
    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    public const VERSIONS          = array (
  'chillerlan/php-qrcode' => '4.3.3@6356b246948ac1025882b3f55e7c68ebd4515ae3',
  'chillerlan/php-settings-container' => '2.1.2@ec834493a88682dd69652a1eeaf462789ed0c5f5',
  'doctrine/annotations' => '1.10.3@5db60a4969eba0e0c197a19c077780aadbc43c5d',
  'doctrine/cache' => '1.10.2@13e3381b25847283a91948d04640543941309727',
  'doctrine/collections' => '1.6.6@5f0470363ff042d0057006ae7acabc5d7b5252d5',
  'doctrine/common' => '3.0.2@a3c6479858989e242a2465972b4f7a8642baf0d4',
  'doctrine/dbal' => '2.10.2@aab745e7b6b2de3b47019da81e7225e14dcfdac8',
  'doctrine/event-manager' => '1.1.0@629572819973f13486371cb611386eb17851e85c',
  'doctrine/inflector' => '1.4.3@4650c8b30c753a76bf44fb2ed00117d6f367490c',
  'doctrine/instantiator' => '1.3.1@f350df0268e904597e3bd9c4685c53e0e333feea',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'doctrine/orm' => 'v2.7.3@d95e03ba660d50d785a9925f41927fef0ee553cf',
  'doctrine/persistence' => '2.0.0@1dee036f22cd5dc0bc12132f1d1c38415907be55',
  'doctrine/reflection' => '1.2.1@55e71912dfcd824b2fdd16f2d9afe15684cfce79',
  'igorescobar/jquery-mask-plugin' => 'v1.14.1@678a7df1f0bb275ce53f365b91af99d86850978d',
  'laminas/laminas-escaper' => '2.9.0@891ad70986729e20ed2e86355fcf93c9dc238a5f',
  'mpdf/mpdf' => 'v8.0.6@d27aa93513b915896fa7cb53901d3122e286f811',
  'myclabs/deep-copy' => '1.10.1@969b211f9a51aa1f6c01d1d2aef56d3bd91598e5',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'ocramius/package-versions' => '1.9.0@94c9d42a466c57f91390cdd49c81313264f49d85',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'phpmailer/phpmailer' => 'v6.5.3@baeb7cde6b60b1286912690ab0693c7789a31e71',
  'phpoffice/phpword' => '0.18.2@aca10785cf68dc95d7f6fac4fe854979fef3f8db',
  'pimple/pimple' => 'v3.3.0@e55d12f9d6a0e7f9c85992b73df1267f46279930',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'setasign/fpdi' => 'v2.3.3@50c388860a73191e010810ed57dbed795578e867',
  'slim/php-view' => '2.2.1@a13ada9d7962ca1b48799c0d9ffbca4c33245aed',
  'slim/slim' => '3.12.3@1c9318a84ffb890900901136d620b4f03a59da38',
  'smalot/pdfparser' => 'v0.16.2@5faf073f308b084496ed6bd512deabb680ca7128',
  'symfony/console' => 'v5.1.2@34ac555a3627e324b660e318daa07572e1140123',
  'symfony/polyfill-ctype' => 'v1.17.1@2edd75b8b35d62fd3eeabba73b26b8f1f60ce13d',
  'symfony/polyfill-intl-grapheme' => 'v1.17.1@6e4dbcf5e81eba86e36731f94fe56b1726835846',
  'symfony/polyfill-intl-normalizer' => 'v1.17.1@40309d1700e8f72447bb9e7b54af756eeea35620',
  'symfony/polyfill-mbstring' => 'v1.17.1@7110338d81ce1cbc3e273136e4574663627037a7',
  'symfony/polyfill-php73' => 'v1.17.1@fa0837fe02d617d31fbb25f990655861bb27bd1a',
  'symfony/polyfill-php80' => 'v1.17.1@4a5b6bba3259902e386eb80dd1956181ee90b5b2',
  'symfony/service-contracts' => 'v2.1.3@58c7475e5457c5492c26cc740cc0ad7464be9442',
  'symfony/string' => 'v5.1.2@ac70459db781108db7c6d8981dd31ce0e29e3298',
  'thiagoalessio/tesseract_ocr' => '2.12.0@0f10bd7b02bdcba59c4fbd98fbd93a56f93b09b7',
  '__root__' => 'dev-master@2d5af52c2735c4e34fc665e808f625c926ced870',
);

    private function __construct()
    {
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}