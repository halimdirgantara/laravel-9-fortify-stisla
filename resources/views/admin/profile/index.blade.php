@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote.min.css') }}">
@endpush

@section('main')

    <div class="section-header">
        <h1>{{ $title }}</h1>
    </div>
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills" id="profile-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                                    role="tab" aria-controls="home" aria-selected="true">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password"
                                    role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="profile-content">
                            <div class="tab-pane fade active show" id="edit-profile" role="tabpanel"
                                aria-labelledby="edit-profile">
                                <form name="update_profile" action="{{ route('profile.update') }}" method="post"
                                    class="needs-validation" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Name</label>
                                            <input name="name" type="text" class="form-control"
                                                value="{{ $user->name }}" required>
                                            <div class="invalid-feedback">
                                                Please fill in the first name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control"
                                                value="{{ $user->email }}" required>
                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-6">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="change-password" role="tabpanel"
                                aria-labelledby="change-password">
                                <form action="{{ route('user.change_password') }}" name="change_password" method="post" class="needs-validation" novalidate="">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-md-6 col-6">
                                            <label>Old Password</label>
                                            <input name="old_password" type="password" class="form-control" value=""
                                                required>
                                            <div class="invalid-feedback">
                                                Please fill in old password
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-6">
                                            <label>New Password</label>
                                            <input name="new_password" id="new_password" type="password" class="form-control" value=""
                                                required>
                                            <div class="invalid-feedback">
                                                Please fill in new password
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-6">
                                            <label>Confirm New Password</label>
                                            <input name="confirm_new_password" id="confirm_new_password" type="password" class="form-control"
                                                value="" required>
                                            <div class="invalid-feedback">
                                                Please fill in new password
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-6">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

@endpush
