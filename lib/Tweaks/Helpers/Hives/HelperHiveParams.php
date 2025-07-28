<?php

namespace Tweaks\Helpers\Hives;

use Exception;
use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveParams extends HelperHive
{
    protected string $hivePrefix = EnumSystem::PARAMS->name;

    /**
     * @throws Exception
     */
    public function __set($key, $val)
    {
        throw new Exception('Method not exists');
    }

    /**
     * @throws Exception
     */
    public function set($key, $val = null, $ttl = 0)
    {
        throw new Exception('Method not exists');
    }

    /**
     * @throws Exception
     */
    public function clear($key): void
    {
        throw new Exception('Method not exists');
    }
}