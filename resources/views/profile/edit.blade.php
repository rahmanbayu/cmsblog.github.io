@extends('layouts.app')

@section('content')

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">

                  <div class=" text-center">
                    @if ($user->image)
                    <img src="{{ Storage::url( $user->image ) }}" width="70px" style="border-radius: 50%" alt="">
                    @else
                    <img src="{{ Gravatar::src( $user->email ) }}" width="70px" alt="">
                    @endif
                  </div>

                  <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" class="form-control" id="name" disabled value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" class="form-control-file" name="image" id="image">
                    </div>

                    <div class="form-group">
                      <label for="about">About</label>
                      <textarea class="form-control" name="about" id="about" rows="3">{{ $user->about }}</textarea>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>



                  </form>
                </div>
            </div>
        </div>

@endsection
