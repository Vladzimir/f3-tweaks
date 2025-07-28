<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveSession extends HelperHive
{
    protected string $hivePrefix = EnumSystem::SESSION->name;
}