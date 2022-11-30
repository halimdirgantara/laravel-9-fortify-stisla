<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\DataTable\CategoryDataTable;
use Illuminate\Database\Eloquent\Builder;


class categoryService {
    private $CategoryDataTable;

    public function __construct(CategoryDataTable $CategoryDataTable) {
        $this->CategoryDataTable = $CategoryDataTable;
    }

    public function getAllCategory() {
        $getAllCategory = Category::get();
        return $getAllCategory;
    }

    public function getCategoryPost() {
        $getAllCategory = Category::with('posts')->get();
        return $getAllCategory;
    }

    public function countPostCategory() {
        $getAllCategory = Category::withCount(['posts' => function (Builder $query) {
            $query->where('status', '=', 'published');
        }])->get();
        return $getAllCategory;
    }

    public function getCategoryById($id) {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function getCategoryByName($slug) {
        $category = Category::where('slug', $slug)->first();
        return $category;
    }

    public function storeCategory($request) {
        try {
            DB::beginTransaction();
            $createCategory = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return $createCategory;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function updateCategory($request, $category) {
        try {
            DB::beginTransaction();
            $updateCategory = $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return $updateCategory;
        } catch (Throwable $th) {
            DB::rollback();
            return false;
        }
    }

    public function checkCategoryDelete($category) {
        $checkPostCategory = Category::find($category->id)->post;
        if($checkPostCategory->isEmpty()) {
            return true;
        }
        return false;
    }


}
