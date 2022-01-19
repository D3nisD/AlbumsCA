@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Edit Album
          </div>
          <div class="card-body">
          <!-- this block is ran if the validation code in the controller fails
          this code looks after displaying the correct error message to the user -->
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ route('admin.albums.update', $album->id)}}">
              <input type="hidden" name="_token" value="{{  csrf_token()  }}">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="title">name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $album->name) }}" />
              </div>
              <div class="form-group">
                <label for="artist">Artist</label>
                <input type="text" class="form-control" id="artist" name="artist" value="{{ old('artist', $album->artist) }}" />
              </div>
              <div class="form-group">
                <label for="Price">Price</label>
                <input type="text" class="form-control" id="Price" name="Price" value="{{ old('price', $album->price) }}" />
              </div>
              <div class="form-group">
                <label for="no_of_tracks">Number of Tracks on the album</label>
                <input type="date" class="form-control" id="no_of_tracks" name="no_of_tracks" value="{{ old('no_of_tracks', $album->no_of_tracks) }}" />
              </div>
              <a href="{{ route('admin.albums.index') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
