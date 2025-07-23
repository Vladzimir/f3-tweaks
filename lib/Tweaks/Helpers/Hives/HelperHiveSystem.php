<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Helpers\HelperHive;
use Tweaks\Tweaks;

class HelperHiveSystem extends HelperHive
{
    protected string $hivePrefix = '';

    public function getAll($args = null): array
    {
        return Tweaks::fw()->hive();
    }
}