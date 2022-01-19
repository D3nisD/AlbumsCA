@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Album: {{ $album->name }}
          </div>
          <div class="card-body">
              <table id="table-albums" class="table table-hover">
                <tbody>
                  <tr>
                      <td rowspan="8"><img src="{{ asset('storage/images/' . $album->image_location) }}" width="150"/></td>
                  </tr>
                  <tr>
                    <td>Title</td>
                    <td>{{ $album->name }}</td>
                  </tr>
                  <tr>
                    <td>Description</td>
                    <td>{{ $album->artist }}</td>
                  </tr>
                  <tr>
                    <td>Location</td>
                    <td>{{ $album->price }}</td>
                  </tr>
                  <tr>
                    <td>Start Date</td>
                    <td>{{ $album->no_of_tracks }}</td>
                  </tr>
                </tbody>
              </table>
              <a href="{{ route('admin.albums.index') }}" class="btn btn-default">Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
