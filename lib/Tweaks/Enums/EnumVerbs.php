<?php

namespace Tweaks\Enums;

use Tweaks\Enums\Interfaces\EnumInterface;
use Tweaks\Enums\Traits\Helpers\EnumTraitHelperName;

enum EnumVerbs implements EnumInterface
{
    use EnumTraitHelperName;

    case GET;
    case HEAD;
    case POST;
    case PUT;
    case PATCH;
    case DELETE;
    case CONNECT;
    case OPTIONS;
}