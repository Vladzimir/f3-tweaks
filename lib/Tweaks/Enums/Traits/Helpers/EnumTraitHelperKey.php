<?php

namespace Tweaks\Enums\Traits\Helpers;

trait EnumTraitHelperKey
{
    public function key($suffix = ''): string
    {
        $class = get_class($this);
        $parts = explode('\\', $class);
        $key = array_pop($parts);
        $key .= $suffix;

        return $key;
    }
}