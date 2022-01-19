@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Albums
            <a href="{{ route('admin.albums.create') }}" class="btn btn-primary float-right">Add</a>
          </div>
          <div class="card-body">
            @if (count($albums)=== 0)
              <p>There are no Albums!</p>
            @else
            <table id="table-albums" class="table table-hover">
                <thead>
                  <th>Title</th>
                  <th>Artist</th>
                  <th>Price</th>
                  <th>Number of tracks on the album</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach ($albums as $album)
                    <tr data-id="{{ $album->id }}">
                      <td>{{ $album->name }}</td>
                      <td>{{ $album->artist }}</td>
                      <td>{{ $album->price }}</td>
                      <td>{{ $album->no_of_tracks }}</td>
                      <td>
                        <a href="{{ route('admin.albums.show', $album->id) }}" class="btn btn-default">View</a>
                        <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-warning">Edit</a>
                        <form style="display:inline-block" method="POST" action="{{ route('admin.albums.destroy', $album->id) }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                          <button type="submit" class="form-cotrol btn btn-danger">Delete</a>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
