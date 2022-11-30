<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" class="form-control" required name="title" value="{{ old('title') ?? $post->title }}" autofocus>
</div>
@error('title')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
<div class="form-group">
    <label for="content">Content</label>
    <div id="editor" name="editor">
        {!! old('content') ?? $post->content !!}
    </div>
    <input type="hidden" id="content" name="content"></input>
</div>
@error('content')
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
            <option {{ !empty($post->category) ? ($post->category->name == $category->name ? 'selected' : '') : '' }} value="{{ $category->id }}">{{ $category->name }} </option>
        @endforeach
    </select>
    @error('category')
        <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image</label>
    <div id="image-preview" class="image-preview" style="background-repeat: no-repeat; background-size: cover;background-image: url('{{  asset(Storage::url($post->image)) }}')">
        <label for="image-upload" id="image-label">Choose File</label>
        <input type="file" name="image" id="image-upload">
    </div>
</div>
@error('image')
    <div class="alert alert-danger mt-2">
        {{ $message }}
    </div>
@enderror
<div class="form-group">
    <label for="status">Status</label>
    <br>
    <select name="status" id="status" class="form-control select2">
        <option value="" selected>--Select Status --</option>
        @foreach(\App\Enums\StatusEnum::cases() as $status)
            <option {{ !empty($post->status) ? ($post->status->value == $status->value ? 'selected' : '') : '' }} value="{{ $status->value }}">{{ $status->name }} </option>
        @endforeach
    </select>
    @error('status')
        <div class="mt-2 text-danger">{{ $message }}</div>
    @enderror
</div>
