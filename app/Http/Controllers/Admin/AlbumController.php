<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Hash;


class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('admin.albums.index', [
            // the view can see the albums (the green one)
            'albums' => $albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // when user clicks submit on the create view above
        // the album will be stored in the DB
        $request->validate([
        //    'image_name' => 'mimes:jpeg,bmp,png',
            'name' => 'required',
            'artist' =>'required|max:500',
            'price' => 'required',
            'no_of_tracks' => 'required',
            'image_name' => 'file|image'
        ]);

        $image_name = $request->file('image_name');
        $filename = $image_name->hashName();

        $path = $image_name->storeAs('public/images', $filename);

        // if validation passes create the new book
        $album = new Album();
        $album->name = $request->input('name');
        $album->artist = $request->input('artist');
        $album->price = $request->input('price');
        $album->no_of_tracks = $request->input('no_of_tracks');
        $album->image_name =  $filename;
        $album->save();



        return redirect()->route('admin.albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);

        return view('admin.albums.show', [
            'album' => $album
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the album by ID from the Database
        $album = Album::findOrFail($id);

        // Load the edit view and pass the album to
        // that view
        return view('admin.albums.edit', [
            'album' => $album
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // first get the existing album that the user is update
        $album = Album::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'artist' =>'required|max:500',
        ]);

        // if validation passes then update existing album
        $album->name = $request->input('name');
        $album->artist = $request->input('artist');
        $album->price = $request->input('price');
        $album->no_of_tracks = $request->input('no_of_tracks');
        $album->save();

        return redirect()->route('admin.albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('admin.albums.index');
    }
}
