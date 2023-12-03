<?php

namespace App\Traits;

use App\Models\General;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

trait Ipaymu {
    public $va;
    public $apiKey;

    public function __construct()
    {
        $this->va = config('ipaymu.va');
        $this->apiKey = config('ipaymu.api_key');
    }

    public function signature($body,$method)
    {
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $this->va . ':' . $requestBody . ':' . $this->apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $this->apiKey);
        
        return $signature;
    }
    protected function balance()
    {
        $va           = $this->va; 
        $url          = 'https://sandbox.ipaymu.com/api/v2/balance'; 
        $method       = 'POST';  
        $timestamp    = Date('YmdHis');
        $body['account']    = $va;
        $signature    = $this->signature($body,$method);

        $headers = array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        );

        $data_request = Http::withHeaders(
            $headers
        )->post($url, [
            'account' => $va
        ]);

        $responser = $data_request->object();

        return $responser;
    }

    public function redirect_payment($id,$program,$administrasiS1,$administrasiKursus)
    {
        $user         = User::find($id);
        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode     
        $method       = 'POST'; //method
        $timestamp    = Date('YmdHis');

        // set product
        if ($program == 'S1') {
        $body['product'][]       = "Pendaftaran $program";
        } else {
        $body['product'][]       = "Pendaftaran $program";
        }

        $body['qty'][]           = 1;

        // pricing
        if($program == 'S1') {
        $body['price'][]         = $administrasiS1->amount;
        } else {
        $body['price'][]         = $administrasiKursus->amount;
        }

        $body['referenceId']     = 'ID-' . strtoupper(str_replace(' ', '', General::first()->title)) . '-'.rand(1111,9999);
        $body['returnUrl']       = route('callback.return');
        $body['notifyUrl']       = 'https://32e0-139-192-158-139.ngrok-free.app/callback/notify';
        $body['cancelUrl']       = route('callback.cancel');
        $body['paymentChannel']  = 'qris';
        $body['expired']         = 24;
        $body['buyerName']       = $user->name;
        $body['buyerPhone']      = $user->phone;
        $body['buyerEmail']      = $user->email;
        
        $signature               = $this->signature($body,$method);

        $headers = array(
            'Content-Type'       => 'application/json',
            'signature'          => $signature,
            'va'                 => $va,
            'timestamp'          => $timestamp
        );

        $data_request = Http::withHeaders($headers)->post($url,$body);
        $response     = $data_request->object();

        return $response; 
    }
}