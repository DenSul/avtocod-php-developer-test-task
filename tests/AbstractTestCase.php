<?php

namespace Tests;

use App\Models\User;
use AvtoDev\DevTools\Tests\PHPUnit\AbstractLaravelTestCase;

abstract class AbstractTestCase extends AbstractLaravelTestCase
{

    /**
     * Not create db user
     *
     */

    public function loginWithFakeUser()
    {
        $user = new User([
            'id' => 99,
            'name' => 'yish',
            'login' => 'ItMeBadRobot'
        ]);

        $this->be($user);
        return $user;
    }
}
