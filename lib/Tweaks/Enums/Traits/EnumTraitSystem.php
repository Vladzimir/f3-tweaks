<?php

namespace Tweaks\Enums\Traits;

use Tweaks\Tweaks;

trait EnumTraitSystem
{
    public function name(): string
    {
        return $this->name;
    }

    public function set($val, int $ttl = 0): void
    {
        Tweaks::system()->set($this->name(), $val, $ttl);
    }

    public function get($args = null): mixed
    {
        return Tweaks::system()->get($this->name(), $args);
    }
}