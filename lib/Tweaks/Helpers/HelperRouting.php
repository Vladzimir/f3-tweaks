<?php

namespace Tweaks\Helpers;

use Prefab;
use Tweaks\Enums\EnumRouting;
use Tweaks\Enums\EnumSystem;
use Tweaks\Enums\EnumVerbs;
use Tweaks\Enums\Interfaces\EnumInterfaceAlias;
use Tweaks\Tweaks;

class HelperRouting extends Prefab
{
    protected string $group = '';

    public function group(string $group, callable $callback): void
    {
        $groupBak = $this->group;
        $group = ltrim($group, '/');
        $this->group .= '/' . $group;
        $callback($this);
        $this->group = $groupBak;
    }

    public function route(
        string|array|EnumVerbs $verbs,
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

        if (!is_array($verbs)) {
            $verbs = [$verbs];
        }

        $verbs = array_map(function ($verb) {
            if ($verb instanceof EnumVerbs) {
                return $verb->name();
            }
            return $verb;
        }, $verbs);

        $verbs = implode('|', $verbs);

        $uri = ltrim($this->group . '/' . $uri, '/');

        //GET|POST @alias: /uri [sync]
        $pattern = $verbs . " " . ($alias ? "@{$alias}: " : "") . '/' . $uri . ($types ? " [{$types}]" : "");

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

    public function isCurrentAlias(string|EnumInterfaceAlias $alias): bool
    {
        if ($alias instanceof EnumInterfaceAlias) {
            $alias = $alias->name();
        }
        $alias = ltrim($alias, '@');

        return EnumSystem::ALIAS->get() === $alias;
    }

    protected function toDynamic(string|array $handler): string
    {
        if (is_array($handler) && !is_callable($handler)) {
            $handler = implode('->', $handler);
        }
        return $handler;
    }
}