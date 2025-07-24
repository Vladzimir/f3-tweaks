<?php

namespace Tweaks\Enums\Interfaces;

/**
 * @property-read string $name
 * @property-read string $value
 */
interface EnumInterface
{
    public function name(): string;
}