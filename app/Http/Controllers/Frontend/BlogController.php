<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Services\postService;
use App\Http\Controllers\Controller;
use App\Http\Services\categoryService;
use Illuminate\Database\Eloquent\Builder;

class BlogController extends Controller
{
    private $postService;
    private $categoryService;

    public function __construct(postService $postService, categoryService $categoryService) {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
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

    public function allCategory()
    {
        $allCategory = $this->categoryService->getAllCategory();
        $postCount = $this->postService->getAllPost()->where('status',StatusEnum::Published);
        return view('frontend.blog.category',[
            'allCategory' => $allCategory,
            'postCount' => $postCount
        ]);
    }

    public function getCategory($slug)
    {
        $posts = $this->postService->getPostByCategory($slug)->where('status',StatusEnum::Published);
        $category = $this->categoryService->getCategoryByName($slug);
        return view('frontend.blog.category-show',[
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
