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
        if($type === 'advanced_search') {            
            $key = config('tomtom');
            $apiUrl = 'https://api.tomtom.com/search/2/geometryFilter.json';
            $geometryList = [
                [
                    "position" => "40.80558,-73.96548",
                    "radius" => 100,
                    "type" => "CIRCLE",
                ],
                [
                    "type" => "POLYGON",
                    "vertices" => [
                        "37.7524152343544,-122.43576049804686",
                        "37.70660472542312,-122.43301391601562",
                        "37.712059855877314,-122.36434936523438",
                        "37.75350561243041,-122.37396240234374"
                    ]
                ]
            ];
            $geometryList = json_encode($geometryList);
            $poiList = [
                [
                    "poi" => [
                        "name" => "S Restaurant Toms"
                    ],
                    "address" => [
                        "freeformAddress" => "2880 Broadway, New York, NY 10025"
                    ],
                    "position" => [
                        "lat" => 40.80558,
                        "lon" => -73.96548
                    ]
                    ],
                [
                    "poi" => [
                        "name" => "Yasha Raman Corporation"
                    ],
                    "address" => [
                        "freeformAddress" => "940 Amsterdam Ave, New York, NY 10025"
                    ],
                    "position" => [
                        "lat" => 40.80076,
                        "lon" => -73.96556
                    ]
                ]
            ];
            $poiList = json_encode($poiList);
            $params = "geometryList=" . $geometryList . "&poiList=" . $poiList;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl . "?key=" . $key);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            $response = curl_exec($ch);
            var_dump(curl_error($ch));
            var_dump($response);
            curl_close($ch);
            $data = json_decode($response, true);
            var_dump($data);
            return response()->json([
                'results' => $data,
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
    public function show(Apartment $apartment)
    {
        return response()->json([
            'apartment' => $apartment,
            'success' => true
        ]);
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
