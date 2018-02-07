<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\Employee;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        //dd(request());
        
        $photos = [];
        foreach(Storage::allFiles('public') as $photo) {
            array_push($photos,Storage::url($photo));
           
        }


        //$photos = Storage::allFiles('public');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($photos);

        //Define how many items we want to be visible in each page
        $perPage = 12;

        //Slice the collection to get the items to display in current page
        $currentPagephotos = $collection->slice($currentPage * $perPage, $perPage)->all(); //$ CurrentPageSearchResults = $ Collection-> slice (($ currentPage - 1) * $ PerPage, $ PerPage) -> all ();

        //Create our paginator and pass it to the view
        $paginatedphotos= new LengthAwarePaginator($currentPagephotos, count($collection), $perPage);

        //return view('search', ['results' => $paginatedphotos]);

        return view('\photos.index')->with('photos', $paginatedphotos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = Employee::find($id);
        $path = 'storage/' . $emp->Photo;
        
        return Image::make($path)->resize(204, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->response();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
