<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveFiles extends HelperHive
{
    protected string $hivePrefix = EnumHive::FILES;
}