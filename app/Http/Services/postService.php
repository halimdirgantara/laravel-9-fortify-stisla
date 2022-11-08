<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use App\DataTable\PostDataTable;
use App\Http\Services\fileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class postService {
    private $PostDataTable;
    private $fileService;

    public function __construct(PostDataTable $PostDataTable, fileService $fileService) {
        $this->PostDataTable = $PostDataTable;
        $this->fileService = $fileService;
    }

    public function getAllPost() {
        $getAllPost = Post::with('category')->latest();
        return $getAllPost;
    }

    public function getPostById($id) {
        $post = Post::findOrFail($id);
        return $post;
    }

    public function getPostBySlug($slug) {
        $post = Category::where('slug', $slug)->get();
        return $post;
    }

    public function storePost($request) {
        try {
            DB::beginTransaction();
            $image_path = $this->fileService->saveImage($request->file('image'));
            if($image_path) {
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

    public function updatePost($request, $post) {
        try {
            DB::beginTransaction();
            $image_path = $this->fileService->saveImage($request->file('image'));
            if($image_path) {
                $updatePost = $post->update([
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'image' => $request->image,
                    'category_id' => $request->category_id,
                    'status' => $request->status,
                ]);
                DB::commit();
                return $updatePost;
            }
            $updatePost = $post->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'content' => $request->content,
                'image' => $post->image,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);
            DB::commit();
            return $updatePost;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function checkPostDelete($post) {
        $checkPost = Post::find($post->id);
        if($checkPost->isEmpty()) {
            return true;
        }
        return false;
    }


}
