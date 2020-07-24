@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <div>Tags</div>
            <div>
              <a href="{{ route('tags.create') }}" class="btn btn-success btn-sm">Create Tags</a>
            </div>
          </div>
          </div>

        <div class="card-body"> 

          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Posts</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tags as $tag)
              <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->posts()->withTrashed()->count() }}</td>
                <td width="25%">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="{{ route('tags.edit', $tag) }}" class="btn btn-success btn-sm">Edit</a>
                    </li>
                    <li class="list-inline-item">
                      <form action="{{ route('tags.destroy', $tag) }}" method="post">
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
                <td colspan="2" class="text-center">We dont have tag!</td>
              </tr>
              @endforelse
            </tbody>
          </table>

        </div>
    </div>
  </div>
@endsection