<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 16:14
 */

namespace App\Http\Controllers;

use App\Domain\Post\Post;
use App\Exceptions\PostException;
use App\Http\Requests\PostRequest;
use App\Service\PostServices;
use Illuminate\Http\Request;
use Auth;

class PostsController extends Controller
{
    /** @var PostServices */
    protected $postService;

    /**
     * PostsController constructor.
     * @param PostServices $postService
     */
    public function __construct(PostServices $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $posts = $this->postService->getPosts()->paginate(25);

        return view('posts', compact('posts'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return bool|\Illuminate\Http\RedirectResponse
     */

    public function delete(Request $request, int $id)
    {
        $this->postService->delete($id);
        return response()->redirectTo(route('posts'));
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(PostRequest $request)
    {
        $post = new Post($request->input('post'), Auth::user()->id);
        $this->postService->create($post);

        return response()->redirectTo(route('posts'))->with('status', 'Сообщение успешно отправлено');
    }
}