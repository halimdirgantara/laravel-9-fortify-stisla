<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\DataTable\PostDataTable;
use App\Http\Services\fileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class postService
{
    private $PostDataTable;
    private $fileService;

    public function __construct(PostDataTable $PostDataTable, fileService $fileService)
    {
        $this->PostDataTable = $PostDataTable;
        $this->fileService = $fileService;
    }

    public function getAllPost()
    {
        $getAllPost = Post::with('category')->latest();
        return $getAllPost;
    }

    public function getPostById($id)
    {
        $post = Post::findOrFail($id);
        return $post;
    }

    public function getPostBySlug($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return $post;
    }

    public function getPostByCategory($slug)
    {
        $posts = Post::whereHas('category', function (Builder $query) use ($slug) {
            $query->where('slug', '=', $slug);
        })->latest();
        return $posts;
    }

    public function storePost($request)
    {
        try {
            DB::beginTransaction();
            $image_path = $this->fileService->saveImage($request->file('image'));
            if ($image_path) {
                $createPost = Post::create([
                    'title' => $request->title,
                    'slug' => STR::slug($request->title),
                    'content' => $request->content,
                    'image' => $image_path,
                    'category_id' => $request->category,
                    'user_id' => Auth::user()->id,
                    'status' => $request->status,
                ]);
                DB::commit();
                return $createPost;
            }
            DB::rollback();
            return false;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updatePost($request, $post, $fileImage)
    {
        try {
            DB::beginTransaction();
            $image_path = $this->fileService->saveImage($fileImage);
            !empty($fileImage) ? $this->fileService->deleteImage($post->image) : '';
            $updatePost = $post->update([
                'title' => $request->title,
                'slug' => STR::slug($request->title),
                'content' => $request->content === null ? $post->content : $request->content,
                'image' => !empty($fileImage) ? $image_path : $post->image,
                'category_id' => $request->category,
                'status' => $request->status,
            ]);
            DB::commit();
            return $updatePost;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function checkPostDelete($post)
    {
        $checkPost = Post::find($post->id);
        if (!empty($checkPost)) {
            $postImageDelete = $this->fileService->deleteImage($post->image);
            return $postImageDelete;
        }
        return false;
    }

}
