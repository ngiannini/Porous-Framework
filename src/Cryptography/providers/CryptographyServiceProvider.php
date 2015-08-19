<?php

namespace Porous\Cryptography\Providers;

use League\Container\ServiceProvider;
use Porous\Cryptography\Encrypt;
use Porous\Cryptography\Hash;

class CryptographyServiceProvider extends ServiceProvider
{
    protected $provides = [
        'crypt',
        'hash',
        'Porous\Cryptography\EncryptInterface',
        'Porous\Cryptography\HashInterface',
    ];

    public function register()
    {
        $encryptConfig = $this->getContainer()->get('app')->getConfig('encryption');
        $hashConfig = $this->getContainer()->get('app')->getConfig('hashing');

        $this->getContainer()->singleton('Porous\Cryptography\EncryptInterface', function () use ($encryptConfig) {
            return new Encrypt(
                $encryptConfig['cipher'],
                $encryptConfig['mode'],
                $encryptConfig['key'],
                $encryptConfig['options']
            );
        });
        $this->getContainer()->singleton('crypt', 'Porous\Cryptography\EncryptInterface');

        $this->getContainer()->singleton('Porous\Cryptography\HashInterface', function () use ($encryptConfig, $hashConfig) {
            return new Hash(
                $hashConfig['hash_algo'],
                $hashConfig['hmac_algo'],
                $hashConfig['pass_algo'],
                $encryptConfig['key']
            );
        });
        $this->getContainer()->singleton('hash', 'Porous\Cryptography\HashInterface');
    }
}