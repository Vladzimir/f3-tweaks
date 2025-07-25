<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Enums\EnumRouting;
use Tweaks\Enums\Interfaces\EnumInterfaceAlias;
use Tweaks\Tweaks;

class HelperRouting extends Prefab
{
    public function route($verbs, $alias, $uri, $handler, $types = EnumRouting::TYPE_SYNC, $ttl = 0, $kbps = 0): void
    {
        $uri = trim($uri, '/');
        if ($alias instanceof EnumInterfaceAlias) {
            $alias = $alias->name();
        }
        $alias = ltrim($alias, '@');
        $types = trim($types, '[]');

        if (is_array($verbs)) {
            $verbs = implode('|', $verbs);
        }

        //GET|POST @alias: /uri [sync]
        $pattern = $verbs . ' ' . ($alias ? '@' . $alias . ': ' : '') . '/' . $uri . ($types ? ' [' . $types . ']' : '');

        $handler = $this->toDynamic($handler);

        Tweaks::fw()->route($pattern, $handler, $ttl, $kbps);
    }

    public function rest($alias, $uri, $handler, $ttl = 0, $kbps = 0): void
    {
        $verbs = [
            EnumRouting::VERB_GET,
            EnumRouting::VERB_POST,
            EnumRouting::VERB_PUT,
            EnumRouting::VERB_DELETE,
        ];

        foreach ($verbs as $verb) {
            $this->route($verb, $alias, $uri, [$handler, strtolower($verb)], '', $ttl, $kbps);
        }
    }

    public function reroute($url = null, $permanent = false, $die = true): void
    {
        if ($url instanceof EnumInterfaceAlias) {
            $url = '@' . $url->name();
        }

        Tweaks::fw()->reroute($url, $permanent, $die);
    }

    protected function toDynamic($handler)
    {
        if (is_array($handler)) {
            $handler = implode('->', $handler);
        }
        return $handler;
    }
}