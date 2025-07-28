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

    public function getUrl($params = [], $query = []): string
    {
        return Tweaks::url()->getUrlByAlias($this, $params, $query);
    }

    public function getUri($params = [], $query = []): string
    {
        return Tweaks::url()->alias($this, $params, $query);
    }

    public function route($verbs, $uri, $handler, $types = EnumRouting::TYPE_SYNC, $ttl = 0, $kbps = 0): void
    {
        Tweaks::routing()->route($verbs, $this, $uri, $handler, $types, $ttl, $kbps);
    }

    public function rest($uri, $handler, $ttl = 0, $kbps = 0): void
    {
        Tweaks::routing()->rest($this, $uri, $handler, $ttl, $kbps);
    }

    public function reroute($permanent = false, $die = true): void
    {
        Tweaks::routing()->reroute($this, $permanent, $die);
    }
}