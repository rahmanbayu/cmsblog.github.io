@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div>{{ isset($category) ? 'Edit' : 'Create' }} Category</div>
          </div>
              <div class="card-body">

              <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="post">
                @csrf
                @if (isset($category))
                  @method('PUT')
                @endif
                <div class="form-group">
                  <label for="name">name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($category) ? $category->name : '' }}">
                  @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="text-center my-3">
                  <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Edit' : 'Create' }}</button>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>
@endsection