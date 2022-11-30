@extends('layouts.blog')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Blog')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
<div class="section-header">
    <h1>Blog</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('homepage') }}">Homepage</a></div>
        <div class="breadcrumb-item">Blog</div>
    </div>
</div>
@can('post create')
<a href="{{ route('post.create')}}" class="btn btn-primary mb-4">Add New Post</a>
@endcan
<div class="section-body">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <article class="article article-style-b">
                <div class="article-header">
                    <div class="article-image" data-background="{{asset(Storage::url($post->image))}}"
                        style="background-image: url({{asset(Storage::url($post->image))}});">
                    </div>
                    @if($post->created_at == date('Y-m-d H:i:s'))
                    <div class="article-badge">
                        <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> New !</div>
                    </div>
                    @endif
                </div>
                <div class="article-details">
                    <div class="article-title">
                        <h2><a href="{{ route('blog.show',$post->slug) }}">{{ $post->title }}</a></h2>
                    </div>
                    <p>{!! Str::limit($post->content, 100) !!}</p>
                    <div class="article-cta">
                        <a href="{{ route('blog.show',$post->slug)}}">Read More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
            </article>
        </div>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
@endsection

@section('modal')

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
