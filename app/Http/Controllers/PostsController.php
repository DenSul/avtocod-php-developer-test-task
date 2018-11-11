<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 11/11/2018
 * Time: 16:14
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        return view('posts');
    }
}