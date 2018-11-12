<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Models\User;
use Faker\Factory;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends AbstractTestCase
{
    /**
     * Проверка страницы
     */

    public function testPostPageIsAvailable(): void
    {
        $response = $this->get(route('posts'));
        $response->assertStatus(200);
    }

    /**
     * Пробуем создать сообщение не авторизованным юзером
     */

    public function testPostNonAuthCreate(): void
    {
        $response = $this->post('post.create', ['post' => 'Hello world']);
        $response->assertStatus(404);
    }

    /**
     * Пробуем создать пост ПУСТОЙ авторизованным юзером
     * Редикт будет на post, сообщение не должно создаваться.
     */

    public function testPostAuthBadPayload(): void
    {
        $user = factory(User::class)->create();

        $initCountPosts     = app(Posts::class)->count();
        $response           = $this->actingAs($user)->post(route('post.create'), ['post' => '  ']);
        $actualCountPosts   = app(Posts::class)->count();

        $response->assertStatus(302);
        $response->assertRedirect(route('post.create'));
        $this->assertEquals($initCountPosts, $actualCountPosts);
    }

    /**
     * Тоже самое, только сейчас все ок будет
     */

    public function testPostAuthGoodPayload(): void
    {
        $user = factory(User::class)->create();

        $initCountPosts     = app(Posts::class)->count();
        $response           = $this->actingAs($user)->post(route('post.create'), ['post' => 'Hello World!']);
        $actualCountPosts   = app(Posts::class)->count();

        $response->assertStatus(302)->assertRedirect(route('home'));
        $this->assertGreaterThan($initCountPosts, $actualCountPosts);

        $last_message = app(Posts::class)->where('user_id', $user->id)->get()->last();


        $this->assertEquals('Hello World!', $last_message->text);
        $this->assertEquals($user->id, $last_message->user_id);

        $this->actingAs($user)->get(route('home'))->assertStatus(200)->assertSee('Сообщение успешно создано');
    }

    /**
     * Пытаемся удалить чужое сообщение и да, мы не админ
     */

    public function testPostAuthRemoveMessageFromAnotherUser(): void
    {
        $user = factory(User::class)->create(['is_admin' => 0]);

        $randomMessage = app(Posts::class)->inRandomOrder()->get()->first();
        $response = $this->actingAs($user)->get(route('post.delete', $randomMessage->id));

        $response->assertStatus(404);
        $response->assertSee('Что-то пошло не так');
    }

    /**
     * Удаляем свое сообщение
     */

    public function testPostAuthRemoveMessageMy(): void
    {
        $user = factory(User::class)->create(['is_admin' => 0]);
        $user->messages()->save(factory(Posts::class)->make());

        $user->fresh();

        $randomMessage    = $user->messages[0];
        $response         = $this->actingAs($user)->get(route('post.delete', $randomMessage->id));

        $response->assertStatus(302);

        $this->assertEquals(true, $randomMessage->fresh()->trashed());
        $response = $this->actingAs($user)->get(route('home'))->assertSee('Сообщение успешно удалили');
        $response->assertStatus(200);
    }

    /**
     * Тест на удаление от админа
     */

    public function testPostAuthRemoveMessageFromAdmin(): void
    {
        $admin = factory(User::class)->create(['is_admin' => 1]);
        $post  = app(Posts::class)->inRandomOrder()->get()->first();

        $response = $this->actingAs($admin)->get(route('post.delete', $post->id));
        $response->assertStatus(302);

        $this->assertEquals(true, $post->fresh()->trashed());
        $response = $this->actingAs($admin)->get(route('home'))->assertSee('Сообщение успешно удалили');
        $response->assertStatus(200);
    }
}
