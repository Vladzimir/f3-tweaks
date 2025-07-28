<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveEnv extends HelperHive
{
    protected string $hivePrefix = EnumSystem::ENV->name;
}