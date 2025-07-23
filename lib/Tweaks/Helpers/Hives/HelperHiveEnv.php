<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveEnv extends HelperHive
{
    protected string $hivePrefix = EnumHive::ENV;
}