<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 20:57
 */

namespace App\Repository;

use App\Models\Posts;
use App\Domain\Post\Post;

class PostRepository
{

    /**
     * @param  int $id
     * @return mixed
     */

    public function getById(int $id)
    {
        return Posts::where('id', $id)->first();
    }

    /**
     * Да, это анти-паттерн
     *
     * @param  PostRequest $post
     * @return mixed
     */

    public function add(Post $post)
    {
        return Posts::create([
            'text'      => $post->getText(),
            'user_id'   => $post->getUserId()
        ]);
    }

    /**
     * @return mixed
     */

    public function all()
    {
        return Posts::all();
    }

    /**
     * @return mixed
     */

    public function last()
    {
        return Posts::last();
    }

    /**
     * @param Posts $post
     * @return bool|null
     * @throws \Exception
     */

    public function delete(Posts $post)
    {
        return $post->delete();
    }
}