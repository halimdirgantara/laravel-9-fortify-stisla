<div class="row">
    <div class="form-group col-4">
        <label for="name">{{ __('register.fullname') }}</label>
    </div>
    <div class="form-group col-8">
        <input id="name" type="text" class="form-control" required name="name" value="{{ old('name') ?? $user->name }}" autofocus>
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
        <input id="email" type="email" value="{{ old('email') ?? $user->email }}" class="form-control" required name="email">
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
