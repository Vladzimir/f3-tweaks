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

    public function hash(string|array $data, string|array $seed, int $length = 64, bool $binary = false): string
    {
        if (!$data) {
            return '';
        }

        if (is_array($data)) {
            $data = json_encode($data);
        }

        if (is_array($seed)) {
            ksort($seed);
            $seed = json_encode($seed);
        }

        $hash = $this->deriveBytes($data, $length, $seed);
        if (!$binary) {
            $hash = Tweaks::base64()->urlSafeOriginalBase64Encode($hash);
        }

        return $hash;
    }

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
            $chunk = hash_hkdf(self::HKDF_ALGO, $key, $chunkLen, $info . chr($i), System::SEED->get());

            $output .= $chunk;
        }

        return substr($output, 0, $length);
    }
}