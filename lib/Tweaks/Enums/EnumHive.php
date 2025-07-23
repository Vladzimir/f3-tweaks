<?php

namespace Tweaks\Enums;

enum EnumHive
{
    public const string
        COOKIE = 'COOKIE.',
        GET = 'GET.',
        POST = 'POST.',
        REQUEST = 'REQUEST.',
        SESSION = 'SESSION.',
        FILES = 'FILES.',
        SERVER = 'SERVER.',
        ENV = 'ENV.',
        PARAMS = 'PARAMS.',
        HEADERS = 'HEADERS.';
}