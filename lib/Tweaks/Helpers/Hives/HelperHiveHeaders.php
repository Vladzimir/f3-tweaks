<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveHeaders extends HelperHive
{
    protected string $hivePrefix = EnumSystem::HEADERS->name;
}