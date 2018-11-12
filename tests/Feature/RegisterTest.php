<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends AbstractTestCase
{
    /**
     * Проверяем доступность страницы регистрации
     */

    public function testRegisterPageIsAvailable(): void
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
        $response->assertSee('Зарегистрироваться');
    }

    /**
     * Попытка отправить пустую форму
     */

    public function testRegistrationEmptyPayload(): void
    {
        $response = $this->post(route('register'));
        $response->assertStatus(302);
        $response->assertRedirect(route('register'));
    }

    /**
     * Попытка отправить неправильные данные
     */

    public function testRegistrationBadPayload(): void
    {
        $response = $this->post(route('register'), [
            'name'     => 'name',
            'login'    => '1',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('register'));
    }

    /**
     * Попытка успешной регистрации
     */

    public function testRegistrationGoodPayload(): void
    {
        $goodPayload = [
            'name'                  => 'Sultanov Denis',
            'login'                 => 'HelloWorld',
            'password'              => 'StrongPassword1991',
            'password_confirmation' => 'StrongPassword1991'
        ];

        $response = $this->post(route('register'), $goodPayload);
        $newUser  = $this->app->make(User::class)->get()->last();

        $response->assertStatus(302)->assertRedirect(route('home'));
        $this->assertEquals($goodPayload['login'], $newUser->login);
    }
}
