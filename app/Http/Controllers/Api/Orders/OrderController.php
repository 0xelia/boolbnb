<?php

namespace App\Http\Controllers\Api\Orders;


use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Apartment;
use App\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(Request $request, Gateway $gateway){

        $sponsor = Sponsor::find($request->sponsor);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            //token inviato dal frontend, diverso dall'altro
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){

            // sync apartment sponsor params
            $apartment = Apartment::where('id', $request->apartment['id'])->first();
            $actual_date = Carbon::now();
            $expire_date = Carbon::parse($actual_date)->addHours($sponsor->duration);
            
            $apartment->sponsors()->attach($sponsor->id, 
            [
                'transaction_id' => $result->transaction->id,
                'expire_date' => $expire_date
            ]);
            $apartment->sponsors()->sync($sponsor->id);
    
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con successo',
                'id' => $result
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'success' => false,
                'message' => 'Transazione fallita'
            ];
            return response()->json($data, 401);
        }
    }
}
