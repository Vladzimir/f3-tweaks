<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveGet extends HelperHive
{
    protected string $hivePrefix = EnumHive::GET;
}