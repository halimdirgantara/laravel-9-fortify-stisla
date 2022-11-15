@extends('layouts.blog')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Blog')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <h1>HOMEPAGE</h1>
@endsection

@section('modal')

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

@endpush
