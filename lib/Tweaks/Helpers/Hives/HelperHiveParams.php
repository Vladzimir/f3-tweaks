<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Exception;
use Tweaks\Helpers\HelperHive;

class HelperHiveParams extends HelperHive
{
    protected string $hivePrefix = EnumHive::PARAMS;

    public function __set($key, $val)
    {
        throw new Exception('Method not exists');
    }

    public function set($key, $val = null, $ttl = 0)
    {
        throw new Exception('Method not exists');
    }

    public function clear($key): void
    {
        throw new Exception('Method not exists');
    }
}