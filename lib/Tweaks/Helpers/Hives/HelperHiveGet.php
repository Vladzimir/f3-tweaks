<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveGet extends HelperHive
{
    protected string $hivePrefix = EnumSystem::GET->name;
}