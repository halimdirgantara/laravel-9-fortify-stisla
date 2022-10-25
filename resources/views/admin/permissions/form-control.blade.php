<div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" class="form-control" required name="name" value="{{ old('name') ?? $permission->name }}" autofocus>
</div>
@error('name')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
