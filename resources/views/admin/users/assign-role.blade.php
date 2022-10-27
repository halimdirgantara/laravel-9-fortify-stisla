@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main')
<div class="card">
    <div class="card-header">
        <a href="{{ route('user.index')}}"><button class="btn btn-sm btn-success mr-4"><i class="fas fa-arrow-left"></i> Back</button></a>
        <h5 class="mt-2">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('update.user.role',$user) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" readonly name="name" id="name" value="{{ old('name') ?? $user->name }}" class="form-control" required>
                @error('name')
                    <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <br>
                <select name="role" id="role" class="form-control select2">
                    <option value="" selected>--Select Role --</option>
                    @foreach ($roles as $role)
                        <option {{ $user->roles->isEmpty() ?  '' : ($user->roles[0]->name == $role->name ? 'selected' : '') }} value="{{ $role->id }}">{{ $role->name }} </option>
                    @endforeach
                </select>
                @error('permission')
                    <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ $action }}</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.select2').select2();
        });
    </script>
@endpush
