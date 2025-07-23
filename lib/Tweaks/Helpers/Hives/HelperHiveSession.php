<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveSession extends HelperHive
{
    protected string $hivePrefix = EnumHive::SESSION;
}