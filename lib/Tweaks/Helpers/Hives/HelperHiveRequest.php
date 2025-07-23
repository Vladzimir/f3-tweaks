<?php

namespace Tweaks\Helpers\Hives;

use Tweaks\Enums\EnumHive;
use Tweaks\Helpers\HelperHive;

class HelperHiveRequest extends HelperHive
{
    protected string $hivePrefix = EnumHive::REQUEST;
}