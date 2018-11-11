<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 21:34
 */

namespace App\Service;


use App\Domain\Post\Post;
use App\Exceptions\PostException;
use App\Repository\PostRepository;
use Illuminate\Support\Facades\Auth;

class PostServices
{
    /** @var PostRepository */
    protected $postRepository;

    /**
     * PostServices constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return mixed
     */

    public function getPosts()
    {
        return $this->postRepository->last();
    }

    /**
     * @param Post $postRequest
     * @return mixed
     */

    public function create(Post $postRequest)
    {
        $postRequest->setText(strip_tags($postRequest->getText()));

        return $this->postRepository->add($postRequest);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws PostException
     */

    public function delete(int $id)
    {
        $post = $this->postRepository->getById($id);

        if ( $post->user_id == Auth::user()->id || Auth::user()->is_admin )  {
            return $this->postRepository->delete($post);
        }
        else {
            throw new PostException('Невозможно удалить сообщение, это не ваше сообщение или вы не админ!', 500);
        }
    }


}