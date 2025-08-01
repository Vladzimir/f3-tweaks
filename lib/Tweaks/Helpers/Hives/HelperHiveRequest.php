<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveRequest extends HelperHive
{
    protected string $hivePrefix = EnumSystem::REQUEST->name;
}