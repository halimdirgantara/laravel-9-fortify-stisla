@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')

    <div class="card card-primary">

        <div class="lang ml-4 mr-4 mt-4">
            <div class="form-group">
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        <input type="radio" name="lang" value="en" class="selectgroup-input changeLang"
                            {{ session()->get('locale') == 'en' ? 'checked=""' : '' }}>
                        <span class="selectgroup-button">English</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="lang" value="id" class="selectgroup-input changeLang"
                            {{ session()->get('locale') == 'id' ? 'checked=""' : '' }}>
                        <span class="selectgroup-button">Indonesian</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" name="lang" value="es" class="selectgroup-input changeLang"
                            {{ session()->get('locale') == 'es' ? 'checked=""' : '' }}>
                        <span class="selectgroup-button">Spain</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="card-header">
            <h4>{{ __('register.title') }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-4">
                        <label for="name">{{ __('register.fullname') }}</label>
                    </div>
                    <div class="form-group col-8">
                        <input id="name" type="text" class="form-control" required name="name" autofocus>
                    </div>
                    @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="email">{{ __('register.email') }}</label>
                    </div>
                    <div class="form-group col-8">
                        <input id="email" type="email" class="form-control" required name="email">
                        @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label for="password" class="d-block">{{ __('register.password') }}</label>
                    </div>
                    <div class="form-group col-8">
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                            name="password" required>
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                        @error('password')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-4">
                        <label for="password_confirmation"
                            class="d-block">{{ __('register.password_confirmation') }}</label>
                    </div>
                    <div class="form-group col-8">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                            required>
                        @error('password_confirmation')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        {{ __('register.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

    <script type="text/javascript">
        var url = "{{ route('changeLang') }}";

        $(".changeLang").change(function() {
            window.location.href = url + "?lang=" + $(this).val();
        });

        $(document).ready(function() {
            $(".alert").delay(3000).slideUp(1000);
        });
    </script>
@endpush
