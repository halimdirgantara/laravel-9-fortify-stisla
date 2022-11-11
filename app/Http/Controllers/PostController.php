<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Helper\RouteHelper;
use Illuminate\Http\Request;
use App\DataTable\PostDataTable;
use App\Http\Services\fileService;
use App\Http\Services\postService;
use Illuminate\Support\Facades\Gate;
use App\Http\Services\categoryService;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;

class PostController extends Controller
{
    private $postService;
    private $fileService;
    private $categoryService;
    private $PostDataTable;

    public function __construct(
        PostDataTable $PostDataTable,
        postService $postService,
        fileService $fileService,
        categoryService $categoryService
        ) {
            $this->postService = $postService;
            $this->fileService = $fileService;
            $this->categoryService = $categoryService;
            $this->PostDataTable = $PostDataTable;
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get route name from custom route helper
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        $title = 'Post List';
        $newButton = 'Create New Post';
        $getAllPost = $this->postService->getAllPost();
        if($request->ajax()) {
            return $this->PostDataTable->postTable($getAllPost);
        }
        return view('admin.posts.index',[
            'title' => $title,
            'newButton' => $newButton,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // get route name from custom route helper
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        $title = 'Create Post';
        $getAllCategory = $this->categoryService->getAllCategory();
        return view('admin.posts.create',[
            'title' => $title,
            'categories' => $getAllCategory,
            'post' => new Post(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }
        // Save post to database
        $createPost = $this->postService->storePost($request);
        if ($createPost) {
            return redirect()->route('post.index')->with([
                'alert-icon' => 'success',
                'alert-type' => 'Created!',
                'alert-message' => 'Success Create New Post',
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Failed!',
            'alert-message' => 'Create Post Failed:',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }

        $title = 'Edit Post';
        $getAllCategory = $this->categoryService->getAllCategory();
        return view('admin.posts.edit',[
            'title' => $title,
            'categories' => $getAllCategory,
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }
        // update user to database
        $fileImage = $request->file('image');
        $updatePost = $this->postService->updatePost($request, $post, $fileImage);
        if ($updatePost) {
            return redirect()->back()->with([
                'alert-icon' => 'success',
                'alert-type' => 'Updated!',
                'alert-message' => 'Success Updated Post '.$post->title,
            ]);
        }
        return redirect()->back()->with([
            'alert-icon' => 'error',
            'alert-type' => 'Error',
            'alert-message' => 'Update Post Failed:',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $routeName = RouteHelper::getName();
        if (!Gate::allows($routeName)) {
            return redirect()->route('dashboard')->with([
                'alert-icon' => 'error',
                'alert-type' => 'Not Authorized!',
                'alert-message' => 'You are not authorized to view '.$routeName.' page',
            ]);
        }
        // Check user before deleting user
        $check = $this->postService->checkPostDelete($post);
        if($check) {
            $post->delete();
            return response()->json([
                'icon'=>'success',
                'title' => 'Success!',
                'message' => 'Success Delete Post']
            ,200);
        }
        return response()->json([
            'icon'=>'error',
            'title' => 'Error!',
            'message' => 'Failed to delete post!']
        ,403);
    }
}
