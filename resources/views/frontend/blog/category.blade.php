@extends('layouts.blog')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Blog')
@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="section-header">
        <h1>Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('homepage') }}">Homepage</a></div>
            <div class="breadcrumb-item">Category</div>
        </div>
    </div>
@can('category create')
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-4">Add New Category</a>
@endcan
<div class="section-body">
    <div class="row">
        @foreach ($allCategory as $category)
            <div class="col-lg-6">
                <div class="card card-large-icons">
                    <div class="card-icon bg-primary text-white">

                        <h2>{{$postCount->where('id',$category->id)->first()->posts_count}}</h2>
                    </div>
                    <div class="card-body">
                        <h4>{{$category->name}}</h4>
                        <a href="{{route('blog.category.show',$category->slug)}}" class="card-cta">Select Category<i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
@section('modal')
@endsection

@push('scripts')
<!-- JS Libraies -->

<!-- Page Specific JS File -->
@endpush
