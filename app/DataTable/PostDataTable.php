<?php

namespace App\DataTable;
use Illuminate\Support\Str;
use App\Http\Services\postService;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PostDataTable {

    public function postTable ($data) {
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('image', function($row){
                $image = '<a href="#" class="showImage" data-slug="'.$row->slug.'" data-url="'.asset(Storage::url($row->image)).'" data-toggle="modal" data-target="#imageModal"><img src="'.asset(Storage::url($row->image)).'" height="75" alt="'.$row->slug.'" /></a>';
                return $image;
            })
            ->editColumn('content', function($row){
                $content = Str::limit($row->content, 100);
                return $content;
            })
            ->addColumn('category', function($row){
                return $row->category->name;
            })
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-success btn-sm m-1">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm m-1">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action','image','content'])
            ->make(true);
    }

}
