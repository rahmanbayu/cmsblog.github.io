@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    {{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
    @endforeach
@endif --}}
    <div class="card">
        <div class="card-header">
            <div>{{ isset($post) ? 'Edit' : 'Create' }} Post</div>
          </div>
              <div class="card-body">

              <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                  @method('PUT')
                @endif
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ isset($post) ? $post->title : '' }}">
                  @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4">{{ isset($post) ? $post->description : '' }}</textarea>
                  @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                  <label for="content">Content</label>
                  <input id="contant" value="{{ isset($post) ? $post->content : '' }}" class="form-control @error('content') is-invalid @enderror"  type="hidden" name="content">
                  <trix-editor input="contant"></trix-editor>
                  @error('content') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                @if (isset($post))
                <div class="form-group">
                  <label for="image">Old Image</label><br>
                    <img src="{{ Storage::url($post->image) }}" width="100px" alt="">
                </div>
                @endif

                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" id="image">
                  @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                  <label for="published_at">published At</label>
                  <input type="text" class="form-control  @error('published_at') is-invalid @enderror" name="published_at" id="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                  @error('published_at') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                      @if (isset($post))
                          @if ($post->category->id == $category->id)
                              selected
                          @endif
                      @endif
                      >{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>
                
                @if ($tags->count() > 0)
                <div class="form-group">
                  <label for="tags">Tags</label>
                  <select class="form-control" name="tags[]" id="tags" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                      @if ($post->hasTag($tag->id))
                          selected
                      @endif
                    >{{ $tag->name }}</option>
                    @endforeach
                  </select>
                </div>
                @endif


                <div class="text-center my-3">
                  <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Edit' : 'Create' }}</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
@endsection

    @push('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      flatpickr("#published_at", {
        enableTime: true,
        enableSeconds: true
      });

      $(document).ready(function() {
    $('#tags').select2();
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @endpush
    
    @push('custom-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">

  @endpush