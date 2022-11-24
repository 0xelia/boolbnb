<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Apartment;
use App\Service;
use App\Http\Controllers\Controller;
use App\Image;
use App\Sponsor;
use Carbon\Carbon;
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
        $services = Service::all();
        $sponsors = Sponsor::all();
        return view('admin.apartments.create', compact('services', 'sponsors'));
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
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'image' => 'required|image|max:2048',
            'visible' => [
                'required',
                Rule::in(['true', 'false']),
            ],
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'services.*' => 'nullable|exists:services,id',
            'sponsors.*' => 'nullable|exists:sponsors,id',
        ]);

        $params['user_id'] = $user_id;
        $gallery = [];
        $params['visible'] = $params['visible'] === 'true' ? 1 : 0;

        $cover_path = Storage::put('cover_images', $params['image']);
        $params['image'] = $cover_path;

        $apartment = Apartment::create($params);

        if(array_key_exists('services', $params)){
            $apartment->services()->sync($params['services']);
        }
        
        if(array_key_exists('sponsors', $params)){
            $sponsor = Sponsor::where('id', $params['sponsors'])->first();
            $actual_date = Carbon::now();
            $expire_date = Carbon::parse($actual_date)->addHours($sponsor->duration);     
            $apartment->sponsors()->attach($sponsor->id, ['expire_date' => $expire_date]);
            $apartment->sponsors()->sync($params['sponsors']);
        }

        if(array_key_exists('images', $params)){
            foreach($params['images'] as $image){
                $image_params = [];
                $image_path = Storage::put('gallery', $image);
                $image_params['path'] = $image_path;
                $image_params['apartment_id'] = $apartment->id;
                $newImage = Image::create($image_params);
            }
        }
        return redirect()->route('admin.apartments.show', compact('apartment'));
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
        $services = Service::all();
        $sponsors = Sponsor::all();
        return view('admin.apartments.edit', compact('apartment','services', 'sponsors'));
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
        $params = $request->validate([
            'title' => 'required|max:255',
            'rooms_number' => 'required|integer|min:1|max:255',
            'beds_number' => 'required|integer|min:1|max:255',
            'bath_number' => 'required|integer|min:0|max:255',
            'meters' => 'required|integer|min:0|max:65535',
            'address' => 'max:255',
            'latitude' => 'max:255',
            'longitude' => 'max:255',
            'image' => 'image|max:2048',
            'visible' => [
                'required',
                Rule::in(['true', 'false']),
            ],
            'price' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|max:2048',
            'services.*' => 'nullable|exists:services,id',
            'sponsors.*' => 'nullable|exists:sponsors,id',
        ]);

        $params['user_id'] = Auth::id();

        if(!$params['address']){
            $params['address'] = $apartment->address; 
            $params['latitude'] = $apartment->latitude; 
            $params['longitude'] = $apartment->longitude; 
        }

        $params['visible'] = $params['visible'] === 'true' ? 1 : 0;

        if(array_key_exists('image', $params)){

            Storage::delete([$apartment->image]);
            $image_path = Storage::put('cover_images', $params['image']);
            $params['image'] = $image_path;

        } else {
            $params['image'] = $apartment->image;
        }

        if(array_key_exists('services', $params)){
            $apartment->services()->sync($params['services']);
        }
        

        // dd($apartment->sponsors[0]->pivot->sponsor_id);
        // dd($params['sponsors']);
        if(array_key_exists('sponsors', $params) && $params['sponsors'][0] != $apartment->sponsors[0]->pivot->sponsor_id){
            $sponsor = Sponsor::where('id', $params['sponsors'])->first();
            $actual_date = Carbon::now();
            $expire_date = Carbon::parse($actual_date)->addHours($sponsor->duration);     
            $apartment->sponsors()->attach($sponsor->id, ['expire_date' => $expire_date]);
            $apartment->sponsors()->sync($params['sponsors']);
        }
        
        $apartment->update($params);

        if(array_key_exists('images', $params)){

            foreach($params['images'] as $image){
                $image_params = [];
                
                $image_path = Storage::put('gallery', $image);
                $image_params['path'] = $image_path;
                $image_params['apartment_id'] = $apartment->id;
                
                $newImage = Image::create($image_params);
            }
        }

        return redirect()->route('admin.apartments.show', compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        Storage::delete($apartment->image);

        foreach($apartment->images as $img){
            Storage::delete($img->path);
        }

        $apartment->delete();
        return redirect()->route('admin.apartments.index');
    }
}
