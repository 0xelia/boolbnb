<?php

namespace App\Http\Controllers\Api\Apartments;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Service;
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

        if ($type === 'all'){
            $apartments = Apartment::all();
            $service_list = Service::AVAILABLE_SERVICE;

            $apartments->load('sponsors', 'services');
            
            return response()->json([
                'apartments' => $apartments,
                'service_list' => $service_list,
                'success' => true,
            ]);
        }

        if($type === 'advanced_search') {            
            $key = config('tomtom');
            $tokenIpInfo = '25fd5148361122';
            $tomtomApiUrl = 'https://api.tomtom.com/search/2/geometryFilter.json?key=' . $key;
            $ipinfoApiUrl = 'https://ipinfo.io/json?token=' . $tokenIpInfo;
            $response = file_get_contents($ipinfoApiUrl);
            $response = json_decode($response, true);
            $geometryList = [
                [
                    "position" => $response['loc'],
                    "radius" => 20000,
                    "type" => "CIRCLE",
                ],
            ];
            $geometryList = json_encode($geometryList);
            $apartments = Apartment::all()->toArray();
            $poiList = [];
            foreach($apartments as $apartment) {
                $poi = [
                    "poi" => [
                        "name" => $apartment['title']
                    ],
                    "address" => [
                        "freeformAddress" => $apartment['address']
                    ],
                    "position" => [
                        "lat" => $apartment['latitude'],
                        "lon" => $apartment['longitude']
                    ]
                ];
                array_push($poiList, $poi);
            }
            $poiList = json_encode($poiList);             
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tomtomApiUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                "Content-Type: application/json",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $data = <<<DATA
            {
                "poiList": $poiList,
                "geometryList": $geometryList
            }
            DATA;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            // solo per debug
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $respJSON = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($respJSON, true);
            return response()->json([
                'results' => $response['results'],
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
