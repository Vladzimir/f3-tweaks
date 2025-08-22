<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Tweaks;

class HelperCrypto extends Prefab
{
    private const string HKDF_ALGO = 'sha3-512';
    private const string HMAC_ALGO = 'sha3-512';
    private const string HASH_ALGO = 'xxh128';
    private const int HASH_BLOCK = 16;
    private const int HKDF_HASH_LEN = 64; // sha3-512 -> 64 bytes
    public const int MAX_LENGTH = self::HKDF_HASH_LEN * 255; // 64 * 255 = 16320

    public function verify($hashInternal, $hashExternal): bool
    {
        return hash_equals((string)$hashInternal, (string)$hashExternal);
    }

    public function deriveBytes(string $key, int $length = 64, string $info = '', string $seed = ''): string
    {
        $max = self::MAX_LENGTH;
        $chunks = (int)ceil($length / $max);
        $output = '';
        $hash_hkdf = '';

        for ($i = 1; $i <= $chunks; $i++) {
            $chunkLen = ($i === $chunks - 1) ? ($length - strlen($output)) : $max;
            $byte = pack('N', $i);

            $hash_hkdf = hash_hkdf(self::HKDF_ALGO, $key, $chunkLen, $hash_hkdf . $info . $byte, $seed);

            $output .= $hash_hkdf;
        }

        return substr($output, 0, $length);
    }

    public function signature(string $data, string $key, int $maxLength = 64, bool $binary = false): string
    {
        $hash = hash_hmac(self::HMAC_ALGO, $data, $key, true);
        if (!$binary) {
            $hash = Tweaks::base64()->urlSafeOriginalBase64Encode($hash);
        }

        return substr($hash, 0, $maxLength);
    }

    public function fastHash(string $data, int $length = 64, bool $binary = false, array $options = []): string
    {
        $num = (int)ceil($length / self::HASH_BLOCK);
        $output = '';
        $hash = '';

        for ($i = 1; $i <= $num; $i++) {
            $byte = pack('N', $i);

            $hash = hash(self::HASH_ALGO, $hash . $data . $byte, true, $options);

            $output .= $hash;
        }

        if (!$binary) {
            $output = Tweaks::base64()->urlSafeOriginalBase64Encode($output);
        }

        return substr($output, 0, $length);
    }
}