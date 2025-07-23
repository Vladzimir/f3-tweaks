<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveCookie extends HelperHive
{
    protected string $hivePrefix = EnumHive::COOKIE;
}