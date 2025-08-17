<?php

namespace Tweaks;

use Base;
use Cache;
use Helpers\HelperCipher;
use Helpers\HelperPassword;
use Helpers\HelperScrambler;
use Tweaks\Helpers\HelperBase64;
use Tweaks\Helpers\HelperCrypto;
use Tweaks\Helpers\HelperRouting;
use Tweaks\Helpers\HelperUrl;
use Tweaks\Helpers\Hives\HelperHiveCookie;
use Tweaks\Helpers\Hives\HelperHiveEnv;
use Tweaks\Helpers\Hives\HelperHiveFiles;
use Tweaks\Helpers\Hives\HelperHiveGet;
use Tweaks\Helpers\Hives\HelperHiveHeaders;
use Tweaks\Helpers\Hives\HelperHiveParams;
use Tweaks\Helpers\Hives\HelperHivePost;
use Tweaks\Helpers\Hives\HelperHiveRequest;
use Tweaks\Helpers\Hives\HelperHiveServer;
use Tweaks\Helpers\Hives\HelperHiveSession;
use Tweaks\Helpers\Hives\HelperHiveSystem;

class Tweaks
{
    public static function fw(): Base
    {
        return Base::instance();
    }

    public static function cookie(): HelperHiveCookie
    {
        return HelperHiveCookie::instance();
    }

    public static function env(): HelperHiveEnv
    {
        return HelperHiveEnv::instance();
    }

    public static function files(): HelperHiveFiles
    {
        return HelperHiveFiles::instance();
    }

    public static function get(): HelperHiveGet
    {
        return HelperHiveGet::instance();
    }

    public static function params(): HelperHiveParams
    {
        return HelperHiveParams::instance();
    }

    public static function post(): HelperHivePost
    {
        return HelperHivePost::instance();
    }

    public static function request(): HelperHiveRequest
    {
        return HelperHiveRequest::instance();
    }

    public static function server(): HelperHiveServer
    {
        return HelperHiveServer::instance();
    }

    public static function session(): HelperHiveSession
    {
        return HelperHiveSession::instance();
    }

    public static function headers(): HelperHiveHeaders
    {
        return HelperHiveHeaders::instance();
    }

    public static function system(): HelperHiveSystem
    {
        return HelperHiveSystem::instance();
    }

    public static function routing(): HelperRouting
    {
        return HelperRouting::instance();
    }

    public static function url(): HelperUrl
    {
        return HelperUrl::instance();
    }

    public static function base64(): HelperBase64
    {
        return HelperBase64::instance();
    }

    public static function cipher(): HelperCipher
    {
        return HelperCipher::instance();
    }
    public static function crypto(): HelperCrypto
    {
        return HelperCrypto::instance();
    }

    public static function password(): HelperPassword
    {
        return HelperPassword::instance();
    }

    public static function scrambler(): HelperScrambler
    {
        return HelperScrambler::instance();
    }

    public static function cache(): Cache
    {
        return Cache::instance();
    }
}