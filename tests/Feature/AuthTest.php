<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends AbstractTestCase
{
    /**
     * Проверка на доступность страницы авторизации
     */

    public function testGetAuthPageIsAvailable(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('Войти');
    }

    /**
     * Проверка на пустые поля
     */

     public function testAuthEmptyPayload(): void
     {
         $response = $this->post(route('login'));
         $response->assertStatus(302);
         $response->assertRedirect(route('login'));
     }

    /**
     *  Попытка авторизации с фейк-данными
     */

    public function testAuthBadPayload(): void
    {
        $badPayload = [
            'login'     => 'fakerUser',
            'password'  => '123321'
        ];

        $response = $this->post(route('login', $badPayload));
        $response->assertStatus(302)->assertRedirect(route('login'));
        $this->assertEquals(session('errors')->get('login')[0],trans('auth.failed'));//O_o
    }

    /**
     * Попытка успешной авторизации
     */

    public function testAuthGoodPayload(): void
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'login'    => $user->login,
            'password' => 'Secret123321',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    /**
     * Авторизованный пользователь не должен видеть Авторизацию и Регистрацию
     * Но должен видеть выход!
     */

    public function testAuthSeeLinkSingup(): void
    {
        $user = $this->loginWithFakeUser();

        $response = $this->get(route('home'))->assertStatus(200)
                    ->assertDontSee('Регистрация')->assertDontSee('Авторизация');

        $response->assertSee('Выход');
    }

    /**
     * Видны ли ссылки авторизации и регистрации
     */

    public function testGuestShowLink(): void
    {
        $response = $this->get(route('home'))->assertSee('Авторизация')
                    ->assertSee('Регистрация')
                    ->assertStatus(200);
    }
}
