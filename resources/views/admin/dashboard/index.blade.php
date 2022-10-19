@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')

    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="section-body">
        <div class="card card-primary">
            <div class="card-body">
                <p>Full Name : {{ Auth::user()->name }}</p>
                <p>E-Mail : {{ Auth::user()->email }}</p>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
