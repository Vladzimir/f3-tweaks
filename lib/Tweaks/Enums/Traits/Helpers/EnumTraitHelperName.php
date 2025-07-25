<?php

namespace Tweaks\Enums\Traits\Helpers;

trait EnumTraitHelperName
{
    use EnumTraitHelperKey;

    public function name(): string
    {
        return $this->key('_') . $this->name;
    }
}