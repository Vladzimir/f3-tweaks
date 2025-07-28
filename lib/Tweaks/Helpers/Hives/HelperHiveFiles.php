<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveFiles extends HelperHive
{
    protected string $hivePrefix = EnumSystem::FILES->name;
}