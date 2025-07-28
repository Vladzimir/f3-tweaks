<?php

namespace Tweaks\Enums\Traits;

use Tweaks\Enums\EnumRouting;
use Tweaks\Tweaks;
use Tweaks\Enums\Traits\Helpers\EnumTraitHelperKey;

trait EnumTraitAlias
{
    use EnumTraitHelperKey;

    public function name(): string
    {
        return $this->key('__') . $this->name;
    }

    public function getUrl(array $params = [], array $query = []): string
    {
        return Tweaks::url()->getUrlByAlias($this, $params, $query);
    }

    public function getUri(array $params = [], array $query = []): string
    {
        return Tweaks::url()->alias($this, $params, $query);
    }

    public function route(
        string|array $verbs,
        string $uri,
        string|array $handler,
        string $types = EnumRouting::TYPE_SYNC,
        int $ttl = 0,
        int $kbps = 0
    ): void {
        Tweaks::routing()->route($verbs, $this, $uri, $handler, $types, $ttl, $kbps);
    }

    public function rest(string $uri, string $handler, int $ttl = 0, int $kbps = 0): void
    {
        Tweaks::routing()->rest($this, $uri, $handler, $ttl, $kbps);
    }

    public function reroute(bool $permanent = false, bool $die = true): void
    {
        Tweaks::routing()->reroute($this, $permanent, $die);
    }
}