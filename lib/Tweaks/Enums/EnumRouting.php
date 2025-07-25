<?php

namespace Tweaks\Enums;

enum EnumRouting
{
    public const string
        TYPE_AJAX = 'ajax',
        TYPE_SYNC = 'sync',
        TYPE_CLI = 'cli',

        VERB_GET = 'GET',
        VERB_POST = 'POST',
        VERB_PUT = 'PUT',
        VERB_DELETE = 'DELETE';
}