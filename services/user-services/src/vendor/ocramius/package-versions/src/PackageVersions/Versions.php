<?php

declare(strict_types=1);

namespace PackageVersions;

/**
 * This class is generated by ocramius/package-versions, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 */
final class Versions
{
    public const ROOT_PACKAGE_NAME = 'user-service';
    public const VERSIONS          = array (
  'clue/stream-filter' => 'v1.4.1@5a58cc30a8bd6a4eb8f856adf61dd3e013f53f71',
  'container-interop/container-interop' => '1.2.0@79cbf1341c22ec75643d841642dd5d6acd83bdb8',
  'faapz/pdo' => 'v1.11.0@a84ac97d3df7c021ccd4af4b28b2afeb75e42894',
  'firebase/php-jwt' => 'v5.0.0@9984a4d3a32ae7673d6971ea00bae9d0a1abba0e',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'http-interop/http-factory-guzzle' => '1.0.0@34861658efb9899a6618cef03de46e2a52c80fc0',
  'jean85/pretty-package-versions' => '1.2@75c7effcf3f77501d0e0caa75111aff4daa0dd48',
  'monolog/monolog' => '1.24.0@bfc9ebb28f97e7a24c45bdc3f0ff482e47bb0266',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'ocramius/package-versions' => '1.4.0@a4d4b60d0e60da2487bd21a2c6ac089f85570dbb',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'php-http/client-common' => '2.0.0@2b8aa3c4910afc21146a9c8f96adb266e869517a',
  'php-http/curl-client' => '2.0.0@e7a2a5ebcce1ff7d75eaf02b7c85634a6fac00da',
  'php-http/discovery' => '1.7.0@e822f86a6983790aa17ab13aa7e69631e86806b6',
  'php-http/httplug' => 'v2.0.0@b3842537338c949f2469557ef4ad4bdc47b58603',
  'php-http/message' => '1.7.2@b159ffe570dffd335e22ef0b91a946eacb182fa1',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => 'v1.0.0@dc494cdc9d7160b9a09bd5573272195242ce7980',
  'pimple/pimple' => 'v3.2.3@9e403941ef9d65d20cba7d54e29fe906db42cf32',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/http-client' => '1.0.0@496a823ef742b632934724bf769560c2a5c7c44e',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.0@6c001f1daafa3a3ac1d8ff69ee4db8e799a654dd',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.8.0@d09ea80159c1929d75b3f9c60504d613aeb4a1e3',
  'robmorgan/phinx' => 'v0.5.5@da9950a5e5b9314ebf72ddc6317ed587ce9ba8dc',
  'sentry/sdk' => '2.0.3@91c36aec83e4c1c5801b64ef4927b78a5aa8ce7f',
  'sentry/sentry' => '2.1.1@8e27e6c5fcf6f01fc2e5235dd14cc0b2b347d793',
  'slim/php-view' => '2.2.1@a13ada9d7962ca1b48799c0d9ffbca4c33245aed',
  'slim/slim' => '3.12.1@eaee12ef8d0750db62b8c548016d82fb33addb6b',
  'symfony/config' => 'v3.4.30@623fd6be3e5d4112d667003488c8c3ec12b66f62',
  'symfony/console' => 'v3.4.30@12940f20a816c978860fa4925b3f1bbb27e9ac46',
  'symfony/debug' => 'v4.3.3@527887c3858a2462b0137662c74837288b998ee3',
  'symfony/filesystem' => 'v4.3.3@b9896d034463ad6fd2bf17e2bf9418caecd6313d',
  'symfony/options-resolver' => 'v4.3.3@40762ead607c8f792ee4516881369ffa553fee6f',
  'symfony/polyfill-ctype' => 'v1.11.0@82ebae02209c21113908c229e9883c419720738a',
  'symfony/polyfill-mbstring' => 'v1.11.0@fe5e94c604826c35a32fa832f35bd036b6799609',
  'symfony/yaml' => 'v3.4.30@051d045c684148060ebfc9affb7e3f5e0899d40b',
  'tuupola/slim-jwt-auth' => '2.4.0@bca54de41a8207d4d67faf3601a06a96cb7ed48f',
  'vlucas/phpdotenv' => 'v2.6.1@2a7dcf7e3e02dc5e701004e51a6f304b713107d5',
  'zendframework/zend-diactoros' => '2.1.3@279723778c40164bcf984a2df12ff2c6ec5e61c1',
  'doctrine/instantiator' => '1.2.0@a2c590166b2133a4633738648b6b064edae0814a',
  'myclabs/deep-copy' => '1.9.1@e6828efaba2c9b79f4499dae1d66ef8bfa7b2b72',
  'phar-io/manifest' => '1.0.1@2df402786ab5368a0169091f61a7c1e0eb6852d0',
  'phar-io/version' => '1.0.1@a70c0ced4be299a63d32fa96d9281d03e94041df',
  'phpdocumentor/reflection-common' => '1.0.1@21bdeb5f65d7ebf9f43b1b25d404f87deab5bfb6',
  'phpdocumentor/reflection-docblock' => '4.3.1@bdd9f737ebc2a01c06ea7ff4308ec6697db9b53c',
  'phpdocumentor/type-resolver' => '0.4.0@9c977708995954784726e25d0cd1dddf4e65b0f7',
  'phpspec/prophecy' => '1.8.1@1927e75f4ed19131ec9bcc3b002e07fb1173ee76',
  'phpunit/php-code-coverage' => '5.3.2@c89677919c5dd6d3b3852f230a663118762218ac',
  'phpunit/php-file-iterator' => '1.4.5@730b01bc3e867237eaac355e06a36b85dd93a8b4',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '1.0.9@3dcf38ca72b158baf0bc245e9184d3fdffa9c46f',
  'phpunit/php-token-stream' => '2.0.2@791198a2c6254db10131eecfe8c06670700904db',
  'phpunit/phpunit' => '6.5.14@bac23fe7ff13dbdb461481f706f0e9fe746334b7',
  'phpunit/phpunit-mock-objects' => '5.0.10@cd1cf05c553ecfec36b170070573e540b67d3f1f',
  'sebastian/code-unit-reverse-lookup' => '1.0.1@4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
  'sebastian/comparator' => '2.1.3@34369daee48eafb2651bea869b4b15d75ccc35f9',
  'sebastian/diff' => '2.0.1@347c1d8b49c5c3ee30c7040ea6fc446790e6bddd',
  'sebastian/environment' => '3.1.0@cd0871b3975fb7fc44d11314fd1ee20925fce4f5',
  'sebastian/exporter' => '3.1.0@234199f4528de6d12aaa58b612e98f7d36adb937',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.3@7cfd9e65d11ffb5af41198476395774d4c8a84c5',
  'sebastian/object-reflector' => '1.1.1@773f97c67f28de00d397be301821b06708fca0be',
  'sebastian/recursion-context' => '3.0.0@5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
  'sebastian/resource-operations' => '1.0.0@ce990bb21759f94aeafd30209e8cfcdfa8bc3f52',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.1.3@11336f6f84e16a720dae9d8e6ed5019efa85a0f9',
  'webmozart/assert' => '1.4.0@83e253c8e0be5b0257b881e1827274667c5c17a9',
  'user-service' => 'No version set (parsed as 1.0.0)@',
);

    private function __construct()
    {
    }

    /**
     * @throws \OutOfBoundsException If a version cannot be located.
     */
    public static function getVersion(string $packageName) : string
    {
        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new \OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: cannot detect its version'
        );
    }
}