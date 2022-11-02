<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\DataTable\CategoryDataTable;


class categoryService {
    private $CategoryDataTable;

    public function __construct(CategoryDataTable $CategoryDataTable) {
        $this->CategoryDataTable = $CategoryDataTable;
    }

    public function getAllCategory() {
        $getAllCategory = Category::get();
        return $getAllCategory;
    }

    public function getCategoryById($id) {
        $category = Category::findOrFail($id);
        return $category;
    }

    public function getCategoryByName($name) {
        $category = Category::where('name', $name)->get();
        return $category;
    }

    public function storeCategory($request) {
        try {
            DB::beginTransaction();
            $createCategory = Category::create([
                'name' => $request->name,
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
