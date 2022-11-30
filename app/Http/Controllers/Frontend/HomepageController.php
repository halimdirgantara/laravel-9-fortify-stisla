<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Services\postService;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    private $postService;

    public function __construct(postService $postService) {
        $this->postService = $postService;
    }

    public function index() {
        $status = StatusEnum::Published;
        $latestPost = $this->postService->getAllPost()->where('status',$status)->orderByDesc('id')->first();
        $posts = $this->postService->getAllPost()->where('status',$status)->orderByDesc('id')->paginate(5);
        return view('frontend.homepage',[
            'post' => $latestPost,
            'posts' => $posts
        ]);
    }
}
