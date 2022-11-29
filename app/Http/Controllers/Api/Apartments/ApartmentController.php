<?php

namespace App\Http\Controllers\Api\Apartments;

use App\Apartment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if($type === 'sponsored') {
            $apartments = Apartment::has('sponsors')->with('sponsors')->get()->toArray();
            $apartmentsFiltered = array_filter($apartments, function ($apartment) {
                $now = Carbon::now();
                $expire_date = Carbon::parse($apartment['sponsors'][0]['pivot']['expire_date']);
                return $now->lessThan($expire_date);
            });
            return response()->json([
                'apartments' => $apartmentsFiltered,
                'success' => true
            ]);
        }
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
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $apartment = Apartment::where('id', $id)->with('services', 'images')->first();

        if($apartment){
            return response()->json([
                'apartment' => $apartment,
                'success' => true
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
        // return response()->json([
        //     'apartment' => $apartment,
        //     'success' => true
        // ]);
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
        //
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
