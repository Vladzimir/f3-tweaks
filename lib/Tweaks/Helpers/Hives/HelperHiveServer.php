<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveServer extends HelperHive
{
    protected string $hivePrefix = EnumHive::SERVER;
}