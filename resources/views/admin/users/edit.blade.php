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
            <div class="card-header"><a href="{{ route('user.index') }}"><button class="btn btn-sm btn-success mr-4"><i class="fas fa-arrow-left"></i> Back</button></a>
                <h5 class="mt-2">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update',$user) }}" method="POST">
                    @csrf
                    @method("PUT")
                    @include('admin.users.form-control')
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
