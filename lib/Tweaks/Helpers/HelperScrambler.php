<?php

namespace Helpers;

use Prefab;
use Tweaks\Tweaks;

class HelperScrambler extends Prefab
{
    public function scramble($data, $key): string
    {
        $bytes = str_split($data);
        $indices = $this->getShuffledArray(count($bytes), $key);

        $scrambled = [];
        foreach ($indices as $index) {
            $scrambled[] = $bytes[$index];
        }

        return implode('', $scrambled);
    }

    public function unscramble($scrambledData, $key): string
    {
        if (!$scrambledData) {
            return $scrambledData;
        }
        $bytes = str_split($scrambledData);
        $indices = $this->getShuffledArray(count($bytes), $key);

        $unscrambled = array_fill(0, count($bytes), null);
        foreach ($indices as $scrambledIndex => $originalIndex) {
            $unscrambled[$originalIndex] = $bytes[$scrambledIndex];
        }

        return implode('', $unscrambled);
    }

    private function getShuffledArray(int $bytes, $key): array
    {
        $indices = range(0, $bytes - 1);

        usort($indices, function ($a, $b) use ($key) {
            $hashA = Tweaks::hasher()->hash($key, $a, 64, true);
            $hashB = Tweaks::hasher()->hash($key, $b, 64, true);
            return strcmp($hashA, $hashB);
        });
        return $indices;
    }
}