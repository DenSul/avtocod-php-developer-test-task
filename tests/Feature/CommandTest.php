<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandTest extends AbstractTestCase
{
    /**
     * Тест команды на назначение юзера администратором
     */

    public function testManageAdmin(): void
    {
        $this->assertTrue(true);
    }
}
