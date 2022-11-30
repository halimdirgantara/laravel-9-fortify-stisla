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
            <div class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></div>
            <div class="breadcrumb-item">{{ $post->slug }}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{ $post->title }}</h2>
        <p class="section-lead">{{ $post->user->name}}</p>
        <div class="card">
            <div class="card-header">
                <img src="{{asset(Storage::url($post->image))}}" alt="{{$post->slug}}">
            </div>
            <div class="card-body">
                {!! $post->content !!}
            </div>
            <div class="card-footer bg-whitesmoke">
                Share on <a href="#">Whatsapp</a>
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
