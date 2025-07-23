<?php

namespace Tweaks;

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

    public static function cache(): Cache
    {
        return Cache::instance();
    }
}