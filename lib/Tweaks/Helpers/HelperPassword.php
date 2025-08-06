<?php

namespace Helpers;

use Prefab;

class HelperPassword extends Prefab
{
    public function hash($password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verify($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function needsRehash($hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_DEFAULT);
    }
}