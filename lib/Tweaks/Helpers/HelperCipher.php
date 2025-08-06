<?php

namespace Helpers;


use Prefab;
use Random\RandomException;
use Tweaks\Enums\EnumSystem as System;
use Tweaks\Tweaks;

class HelperCipher extends Prefab
{
    protected const int KEY_LENGTH = 32;
    protected const string CIPHER_ALGO = 'chacha20-poly1305';

    /**
     * @throws RandomException
     */
    public function encrypt(string $plaintext, string $key, $binary = false): string
    {
        $nonce = $this->randomString(12, true);
        $tag = '';
        $passphrase = Tweaks::hasher()->hash($key, System::SEED->get(), self::KEY_LENGTH, true);

        $ciphertext = openssl_encrypt($plaintext, self::CIPHER_ALGO, $passphrase, OPENSSL_RAW_DATA, $nonce, $tag);

        $data = $nonce . $tag . $ciphertext;

        if (!$binary) {
            $data = Tweaks::base64()->urlSafeOriginalBase64Encode($data);
        }

        return $data;
    }

    public function decrypt(string $data, string $key, $binary = false): string
    {
        if (!$binary) {
            $data = Tweaks::base64()->urlSafeOriginalBase64Decode($data);
        }

        $nonce = substr($data, 0, 12);
        $tag = substr($data, 12, 16);
        $ciphertext = substr($data, 28);
        $passphrase = Tweaks::hasher()->hash($key, System::SEED->get(), self::KEY_LENGTH, true);

        return openssl_decrypt($ciphertext, self::CIPHER_ALGO, $passphrase, OPENSSL_RAW_DATA, $nonce, $tag);
    }

    public function encryptOneTimePad(string $data, string $key, $binary = false): string
    {
        $randomBytes = Tweaks::hasher()->deriveBytes($key, strlen($data));

        $encrypt = $data ^ $randomBytes;
        $hash = Tweaks::hasher()->hash($encrypt, $key, 32, true);

        $ciphertext = $hash . $encrypt;

        if (!$binary) {
            $ciphertext = Tweaks::base64()->urlSafeOriginalBase64Encode($ciphertext);
        }

        return $ciphertext;
    }

    public function decryptOneTimePad(string $data, string $key, $binary = false): string
    {
        if (!$binary) {
            $data = Tweaks::base64()->urlSafeOriginalBase64Decode($data);
        }

        $hash = substr($data, 0, 32);
        $ciphertext = substr($data, 32);

        $crc = Tweaks::hasher()->hash($ciphertext, $key, 32, true);

        if (Tweaks::hasher()->verify($hash, $crc)) {
            $randomBytes = Tweaks::hasher()->deriveBytes($key, strlen($ciphertext));

            return $data ^ $randomBytes;
        }
        return false;
    }

    /**
     * @throws RandomException
     */
    public function randomString(int $length = 64, bool $binary = false): string
    {
        $randomString = random_bytes($length);
        if (!$binary) {
            $randomString = Tweaks::base64()->urlSafeOriginalBase64Encode($randomString);
            $randomString = substr($randomString, 0, $length);
        }

        return $randomString;
    }
}