<?php

namespace Helpers;


use Prefab;
use Random\RandomException;
use Tweaks\Tweaks;

class HelperCipher extends Prefab
{
    protected const int KEY_LENGTH = 32;
    protected const string CIPHER_ALGO = 'chacha20-poly1305';

    /**
     * @throws RandomException
     */
    public function encrypt(string $plaintext, string $key, bool $binary = false, string $seed = ''): string
    {
        $nonce = $this->randomString(12, true);
        $tag = '';
        $passphrase = Tweaks::crypto()->deriveBytes($key, self::KEY_LENGTH, $nonce, $seed);

        $ciphertext = openssl_encrypt($plaintext, self::CIPHER_ALGO, $passphrase, OPENSSL_RAW_DATA, $nonce, $tag);

        $data = $nonce . $tag . $ciphertext;

        if (!$binary) {
            $data = Tweaks::base64()->urlSafeOriginalBase64Encode($data);
        }

        return $data;
    }

    public function decrypt(string $data, string $key, bool $binary = false, string $seed = ''): string
    {
        if (!$binary) {
            $data = Tweaks::base64()->urlSafeOriginalBase64Decode($data);
        }

        $nonce = substr($data, 0, 12);
        $tag = substr($data, 12, 16);
        $ciphertext = substr($data, 28);
        $passphrase = Tweaks::crypto()->deriveBytes($key, self::KEY_LENGTH, $nonce, $seed);

        return openssl_decrypt($ciphertext, self::CIPHER_ALGO, $passphrase, OPENSSL_RAW_DATA, $nonce, $tag);
    }

    /**
     * @throws RandomException
     */
    public function encryptOneTimePad(string $data, string $key, bool $binary = false, string $seed = ''): string
    {
        $strlen = strlen($data);
        $nonce = $this->randomString(12, true);

        $blob = Tweaks::crypto()->deriveBytes($key, 32 + $strlen, $nonce, $seed);

        $macKey = substr($blob, 0, 32);
        $streamKey = substr($blob, 32);

        $ciphertext = $data ^ $streamKey;
        $tag = Tweaks::crypto()->signature($nonce . $ciphertext, $macKey, 16, true);

        $encrypt = $nonce . $tag . $ciphertext;

        if (!$binary) {
            $encrypt = Tweaks::base64()->urlSafeOriginalBase64Encode($encrypt);
        }

        return $encrypt;
    }

    public function decryptOneTimePad(string $encrypt, string $key, bool $binary = false, string $seed = ''): string
    {
        if (!$binary) {
            $encrypt = Tweaks::base64()->urlSafeOriginalBase64Decode($encrypt);
        }

        $nonce = substr($encrypt, 0, 12);
        $tagExternal = substr($encrypt, 12, 16);
        $ciphertext = substr($encrypt, 28);
        $strlen = strlen($ciphertext);

        $blob = Tweaks::crypto()->deriveBytes($key, 32 + $strlen, $nonce, $seed);

        $macKey = substr($blob, 0, 32);
        $streamKey = substr($blob, 32);

        $tagInternal = Tweaks::crypto()->signature($nonce . $ciphertext, $macKey, 16, true);

        if (Tweaks::crypto()->verify($tagInternal, $tagExternal)) {
            return $ciphertext ^ $streamKey;
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