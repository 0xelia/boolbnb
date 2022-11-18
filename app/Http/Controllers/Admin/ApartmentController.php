<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $apartments = Apartment::where('user_id', $user_id)->paginate(8);
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $params = $request->validate([
            'title' => 'required|max:255',
            'rooms_number' => 'required|integer|min:1|max:255',
            'beds_number' => 'required|integer|min:1|max:255',
            'bath_number' => 'required|integer|min:0|max:255',
            'meters' => 'required|integer|min:0|max:65535',
            'address' => 'required|max:255',
            'image' => 'required|image|max:2048',
            'visible' => [
                'required',
                Rule::in(['true', 'false']),
            ],
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|max:2048'
        ]);
        $params['user_id'] = $user_id;
        $gallery = [];
        $params['visible'] = $params['visible'] === 'true' ? 1 : 0;
        $apartment = Apartment::create($params);
        // dd($apartment);
        // foreach ($request->images as $key => $image) {
        //     $img = Storage::put('gallery', $image);
        //     $gallery[$key]['path'] = $img;
        // }
        // foreach ($gallery as $img) {
        //     Image::create();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        
        if(array_key_exists('image', $params)){

            Storage::delete([$apartment->image]);
            $image_path = Storage::put('image', $params['image']);
            $params['image'] = $image_path;

        } else {
            $params['image'] = $apartment->image;
        }

        $apartment->update($params);
        return redirect()->route('admin.apartments.show', $apartment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
