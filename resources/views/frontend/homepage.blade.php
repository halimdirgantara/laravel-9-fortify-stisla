@extends('layouts.blog')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Blog')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="card">
        <div class="section-header">
            <h1>HOMEPAGE</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">Homepage</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-8 col-sm-6 col-md-6 col-lg-8">
                    <article class="article article-style-b">
                        <div class="article-header" style="height: 580px;">
                            <div class="article-image" data-background="{{ asset(Storage::url($post->image)) }}"
                                style="background-image: url({{ asset(Storage::url($post->image)) }});">
                            </div>
                            @if ($post->created_at == date('Y-m-d H:i:s'))
                                <div class="article-badge">
                                    <div class="article-badge-item bg-danger"><i class="fas fa-fire"></i> New !</div>
                                </div>
                            @endif
                        </div>
                        <div class="article-details">
                            <div class="article-title">
                                <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                            </div>
                            <p>{!! Str::limit($post->content, 200) !!}</p>
                            <div class="article-cta">
                                <a href="{{ route('blog.show', $post->slug) }}">Read More <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Post</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach ($posts as $post)
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="{{ asset(Storage::url($post->image)) }}"
                                        alt="avatar">
                                    <div class="media-body">
                                        <div class="media-title"><a href="{{ route('blog.show', $post->slug) }}">{{$post->title}}</a></div>
                                        <span class="text-small text-muted">{!! Str::limit($post->content, 100) !!}</span>
                                        <a href="{{ route('blog.show', $post->slug) }}">Read More <i
                                            class="fas fa-chevron-right"></i></a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="text-center pt-1 pb-1">
                                <a href="{{ route('blog')}}" class="btn btn-primary btn-lg btn-round">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
