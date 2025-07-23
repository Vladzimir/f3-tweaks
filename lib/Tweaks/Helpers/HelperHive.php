<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Tweaks;

class HelperHive extends Prefab
{
    protected string $hivePrefix;

    public function &__get($key)
    {
        return Tweaks::fw()->{$this->hivePrefix . $key};
    }

    public function __set($key, $val)
    {
        return Tweaks::fw()->{$this->hivePrefix . $key} = $val;
    }

    public function exists($key, &$val = null): bool
    {
        return Tweaks::fw()->exists($this->hivePrefix . $key, $val);
    }

    public function set($key, $val = null, $ttl = 0)
    {
        return Tweaks::fw()->set($this->hivePrefix . $key, $val, $ttl);
    }

    public function clear($key): void
    {
        Tweaks::fw()->clear($this->hivePrefix . $key);
    }

    public function clearAll(): void
    {
        Tweaks::fw()->clear($this->hivePrefix);
    }

    public function get($key, $args = null): mixed
    {
        return Tweaks::fw()->get($this->hivePrefix . $key, $args);
    }

    public function getAll($args = null): mixed
    {
        return Tweaks::fw()->get($this->hivePrefix, $args);
    }

    public function mset(array $vars, $ttl = 0): void
    {
        Tweaks::fw()->mset($vars, $this->hivePrefix, $ttl);
    }
}