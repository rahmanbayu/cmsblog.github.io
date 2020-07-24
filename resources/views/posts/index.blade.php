@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div>Post</div>
            <div>
              <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">Post Create</a>
            </div>
          </div>
          </div>

        <div class="card-body"> 

          <table class="table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($posts as $post)
              <tr>
                <td>
                  <img src="{{ Storage::url($post->image) }}" width="50px" alt="">
                </td>
                <td>{{ $post->title }}</td>
                <td>
                  <a href="{{ route('categories.edit',$post->category) }}">{{ $post->category->name }}</a>
                </td>
                <td width="25%">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      @if ($post->trashed())
                      <form action="{{ route('posts.restore', $post) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                      </form>
                      @else
                      <a href="{{ route('posts.edit', $post) }}" class="btn btn-success btn-sm">Edit</a>
                      @endif
                    </li>
                    <li class="list-inline-item">
                      <form action="{{ route('posts.destroy', $post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </li>
                  </ul>


                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center">We dont have post!</td>
              </tr>
              @endforelse
            </tbody>
          </table>

        </div>
    </div>
  </div>
@endsection