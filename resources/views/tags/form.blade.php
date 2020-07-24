@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div>{{ isset($tag) ? 'Edit' : 'Create' }} Tag</div>
          </div>
              <div class="card-body">

              <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}" method="post">
                @csrf
                @if (isset($tag))
                  @method('PUT')
                @endif
                <div class="form-group">
                  <label for="name">name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($tag) ? $tag->name : '' }}">
                  @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="text-center my-3">
                  <button type="submit" class="btn btn-primary">{{ isset($tag) ? 'Edit' : 'Create' }}</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
@endsection