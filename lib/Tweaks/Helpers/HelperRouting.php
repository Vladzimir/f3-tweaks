<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Enums\EnumRouting;
use Tweaks\Enums\EnumVerbs;
use Tweaks\Enums\Interfaces\EnumInterfaceAlias;
use Tweaks\Tweaks;

class HelperRouting extends Prefab
{
    public function route(
        string|array $verbs,
        string|EnumInterfaceAlias $alias,
        string $uri,
        string|array $handler,
        string $types = EnumRouting::TYPE_SYNC,
        int $ttl = 0,
        int $kbps = 0
    ): void {
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

    public function rest(
        string|EnumInterfaceAlias $alias,
        string $uri,
        string $handler,
        int $ttl = 0,
        int $kbps = 0
    ): void {
        $verbs = [
            EnumVerbs::GET->name(),
            EnumVerbs::POST->name(),
            EnumVerbs::PUT->name(),
            EnumVerbs::DELETE->name(),
        ];

        foreach ($verbs as $verb) {
            $this->route($verb, $alias, $uri, [$handler, strtolower($verb)], '', $ttl, $kbps);
        }
    }

    public function reroute(string|EnumInterfaceAlias $url = null, bool $permanent = false, bool $die = true): void
    {
        if ($url instanceof EnumInterfaceAlias) {
            $url = '@' . $url->name();
        }

        Tweaks::fw()->reroute($url, $permanent, $die);
    }

    protected function toDynamic(string|array $handler): string
    {
        if (is_array($handler)) {
            $handler = implode('->', $handler);
        }
        return $handler;
    }
}