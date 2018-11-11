<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 22:51
 */

namespace App\Widgets\Posts;


use App\Repository\PostRepository;

class Posts
{
    public static function show()
    {
        $repository = new PostRepository();
        $posts = $repository->last()->paginate(25);

        return view('widget.Posts::index', compact('posts'));
    }
}