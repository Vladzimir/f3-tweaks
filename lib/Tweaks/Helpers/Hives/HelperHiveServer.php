<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumSystem;
use Tweaks\Helpers\HelperHive;

class HelperHiveServer extends HelperHive
{
    protected string $hivePrefix = EnumSystem::SERVER->name;
}