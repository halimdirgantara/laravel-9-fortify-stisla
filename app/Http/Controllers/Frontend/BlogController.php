<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Services\postService;
use App\Http\Controllers\Controller;
use App\Enums\StatusEnum;

class BlogController extends Controller
{
    private $postService;

    public function __construct(postService $postService) {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = StatusEnum::Published->value;
        $posts = $this->postService->getAllPost()->where('status',$status)->paginate(8);
        return view('frontend.blog.index',[
            'posts' => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->postService->getPostBySlug($slug);
        return view('frontend.blog.show',[
            'post' => $post,
        ]);
    }

    public function category()
    {
        return view('frontend.blog.category');
    }
}
