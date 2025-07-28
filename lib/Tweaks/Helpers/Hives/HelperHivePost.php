<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHivePost extends HelperHive
{
    protected string $hivePrefix = EnumSystem::POST->name;
}