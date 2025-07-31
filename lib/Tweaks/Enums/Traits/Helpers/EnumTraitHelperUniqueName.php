<?php

namespace Tweaks\Enums\Traits\Helpers;

trait EnumTraitHelperUniqueName
{
    use EnumTraitHelperKey;

    public function name(): string
    {
        return $this->key('_') . $this->name;
    }
}