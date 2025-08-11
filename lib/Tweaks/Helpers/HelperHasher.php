<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Enums\EnumSystem as System;
use Tweaks\Tweaks;

class HelperHasher extends Prefab
{
    private const string HKDF_ALGO = 'sha3-512';
    private const int HKDF_HASH_LEN = 64; // sha3-512 -> 64 bytes
    public const int MAX_LENGTH = self::HKDF_HASH_LEN * 255; // 64 * 255 = 16320

    public function verify($hashInternal, $hashExternal): bool
    {
        return hash_equals((string)$hashInternal, (string)$hashExternal);
    }

    public function deriveBytes(string $key, int $length = 64, string $info = ''): string
    {
        $max = self::MAX_LENGTH;
        $chunks = (int)ceil($length / $max);
        $output = '';

        for ($i = 0; $i < $chunks; $i++) {
            // length for this chunk
            $chunkLen = ($i === $chunks - 1) ? ($length - strlen($output)) : $max;

            // call hash_hkdf for this chunk
            $chunk = hash_hkdf(self::HKDF_ALGO, $key, $chunkLen, $info . $i, System::SEED->get());

            $output .= $chunk;
        }

        return substr($output, 0, $length);
    }

    public function signature(string $data, string $key, int $maxLength = 64, $binary = false): string
    {
        $hash = hash_hmac(self::HKDF_ALGO, $data, $key, true);
        if (!$binary) {
            $hash = Tweaks::base64()->urlSafeOriginalBase64Encode($hash);
        }

        return substr($hash, 0, $maxLength);
    }
}