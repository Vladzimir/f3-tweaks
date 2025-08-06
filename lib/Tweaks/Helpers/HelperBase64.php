<?php

namespace Tweaks\Helpers;

use InvalidArgumentException;
use Prefab;

class HelperBase64 extends Prefab
{
    private string $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';

    public function encode(string $data): string
    {
        $data = str_split($data);
        $data = array_map('ord', $data);

        $leadingZeroes = 0;
        while (!empty($data) && 0 === $data[0]) {
            $leadingZeroes++;
            array_shift($data);
        }
        $converted = $this->baseConvert($data, 256, 64);
        if (0 < $leadingZeroes) {
            $converted = array_merge(
                array_fill(0, $leadingZeroes, 0),
                $converted
            );
        }

        return implode('', array_map(function ($index) {
            return $this->characters[$index];
        }, $converted));
    }

    /**
     * Decode given a base64 string back to data
     */
    public function decode(string $data): string
    {
        $this->validateInput($data);

        $data = str_split($data);

        $data = array_map(function ($character) {
            return strpos($this->characters, $character);
        }, $data);

        $leadingZeroes = 0;
        while (!empty($data) && 0 === $data[0]) {
            $leadingZeroes++;
            array_shift($data);
        }

        $converted = $this->baseConvert($data, 64, 256);

        if (0 < $leadingZeroes) {
            $converted = array_merge(
                array_fill(0, $leadingZeroes, 0),
                $converted
            );
        }

        return implode('', array_map('chr', $converted));
    }

    private function validateInput(string $data): void
    {
        if (strlen($data) !== strspn($data, $this->characters)) {
            $valid = str_split($this->characters);
            $invalid = str_replace($valid, '', $data);
            $invalid = count_chars($invalid, 3);

            throw new InvalidArgumentException(
                "Data contains invalid characters \"{$invalid}\""
            );
        }
    }

    private function baseConvert(array $source, int $sourceBase, int $targetBase): array
    {
        $result = [];
        while ($count = count($source)) {
            $quotient = [];
            $remainder = 0;
            for ($i = 0; $i !== $count; $i++) {
                $accumulator = $source[$i] + $remainder * $sourceBase;
                /* Same as PHP 7 intdiv($accumulator, $targetBase) */
                $digit = ($accumulator - ($accumulator % $targetBase)) / $targetBase;
                $remainder = $accumulator % $targetBase;
                if (count($quotient) || $digit) {
                    $quotient[] = $digit;
                }
            }
            array_unshift($result, $remainder);
            $source = $quotient;
        }

        return $result;
    }

    public function setCharacters($characters): void
    {
        $this->characters = $characters;
    }

    public function getCharacters(): string
    {
        return $this->characters;
    }

    public function urlSafeOriginalBase64Encode(string $input): string
    {
        $encoded = strtr(base64_encode($input), '+/', '-_');

        return rtrim($encoded, '=');
    }

    public function urlSafeOriginalBase64Decode(string $input): string
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }
}