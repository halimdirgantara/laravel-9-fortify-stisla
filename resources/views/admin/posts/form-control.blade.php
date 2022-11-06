<div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" class="form-control" required name="name" value="{{ old('name') ?? $post->name }}" autofocus>
</div>
@error('name')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
<div class="form-group">
    <label for="name">Content</label>
    <input id="name" type="text" class="form-control" required name="name" value="{{ old('name') ?? $post->name }}" >
</div>
@error('name')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
<div class="form-group">
    <label for="category">Category</label>
    <br>
    <select name="category" id="category" class="form-control select2">
        <option value="" selected>--Select Category --</option>
        @foreach ($categories as $category)
            <option  value="{{ $category->id }}">{{ $category->name }} </option>
        @endforeach
    </select>
    @error('permission')
        <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="name">Image</label>
    <div id="image-preview" class="image-preview">
        <label for="image-upload" id="image-label">Choose File</label>
        <input type="file" name="image" id="image-upload">
    </div>
</div>
@error('name')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
