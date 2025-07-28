<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveCookie extends HelperHive
{
    protected string $hivePrefix = EnumSystem::COOKIE->name;
}