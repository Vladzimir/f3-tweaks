<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Tweaks;

class HelperHive extends Prefab
{
    protected string $hivePrefix;

    public function &__get($key)
    {
        return Tweaks::fw()->{$this->getHivePrefix() . $key};
    }

    public function __set($key, $val)
    {
        return Tweaks::fw()->{$this->getHivePrefix() . $key} = $val;
    }

    public function exists($key, &$val = null): bool
    {
        return Tweaks::fw()->exists($this->getHivePrefix() . $key, $val);
    }

    public function set($key, $val = null, int $ttl = 0): mixed
    {
        return Tweaks::fw()->set($this->getHivePrefix() . $key, $val, $ttl);
    }

    public function clear($key): void
    {
        Tweaks::fw()->clear($this->getHivePrefix() . $key);
    }

    public function clearAll(): void
    {
        Tweaks::fw()->clear($this->hivePrefix);
    }

    public function get($key, $args = null): mixed
    {
        return Tweaks::fw()->get($this->getHivePrefix() . $key, $args);
    }

    public function getAll($args = null): mixed
    {
        return Tweaks::fw()->get($this->hivePrefix, $args);
    }

    public function mset(array $vars, int $ttl = 0): void
    {
        Tweaks::fw()->mset($vars, $this->getHivePrefix(), $ttl);
    }

    private function getHivePrefix(): string
    {
        return $this->hivePrefix ? $this->hivePrefix . '.' : '';
    }
}