<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Enums\EnumSystem as System;
use Tweaks\Enums\Interfaces\EnumInterfaceAlias;
use Tweaks\Tweaks;

class HelperUrl extends Prefab
{
    public function alias(string|EnumInterfaceAlias $alias_name, array $params = [], array $query = []): string
    {
        if ($alias_name instanceof EnumInterfaceAlias) {
            $alias_name = $alias_name->name();
        }

        $alias_name = ltrim($alias_name, '@');

        return Tweaks::fw()->alias($alias_name, $params, $query);
    }

    public function getUrl(string $uri, string $host = null): string
    {
        $port = System::PORT->get();
        $port = in_array($port, [80, 443]) ? '' : (':' . $port);

        if (!$host) {
            $host = System::HOST->get();
        }

        return System::SCHEME->get() . '://' . $host . $port . System::BASE->get() . $uri;
    }

    public function getUrlByAlias(string|EnumInterfaceAlias $alias, array $params = [], array $query = []): string
    {
        return $this->getUrl($this->alias($alias, $params, $query));
    }
}