<?php
namespace Tweaks\Enums;

use Tweaks\Enums\Interfaces\EnumInterface;
use Tweaks\Enums\Traits\EnumTraitSystem;

enum EnumSystem implements EnumInterface

{
    use EnumTraitSystem;

    case ALIAS;
    case ALIASES;
    case AUTOLOAD;
    case CACHE;
    case CASELESS;
    case CONTAINER;
    case COOKIE;
    case GET;
    case POST;
    case REQUEST;
    case SESSION;
    case FILES;
    case SERVER;
    case ENV;
    case CORS;
    case DEBUG;
    case DIACRITICS;
    case DNSBL;
    case EMOJI;
    case ENCODING;
    case ESCAPE;
    case EXEMPT;
    case EXCEPTION;
    case FALLBACK;
    case FORMATS;
    case FRAGMENT;
    case HALT;
    case HIGHLIGHT;
    case JAR;
    case LANGUAGE;
    case LOCALES;
    case LOGGABLE;
    case LOGS;
    case ONERROR;
    case ONREROUTE;
    case PACKAGE;
    case PARAMS;
    case PLUGINS;
    case PREFIX;
    case PREMAP;
    case QUIET;
    case RAW;
    case ROUTES;
    case SEED;
    case SERIALIZER;
    case TEMP;
    case TIME;
    case TZ;
    case UI;
    case UNLOAD;
    case UPLOADS;
    case URI;
    case VERB;
    case VERSION;
    case XFRAME;
    case AGENT;
    case AJAX;
    case BASE;
    case BODY;
    case CLI;
    case ERROR;
    case HEADERS;
    case HOST;
    case IP;
    case PATH;
    case PATTERN;
    case PORT;
    case QUERY;
    case REALM;
    case RESPONSE;
    case ROOT;
    case SCHEME;
}