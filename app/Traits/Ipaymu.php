<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

trait Ipaymu {
    public $va;
    public $apiKey;

    public function __construct()
    {
        $this->va = config('Ipaymu.va');
        $this->apiKey = config('Ipaymu.api_key');
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

    public function redirect_payment($id)
    {
        $user         = User::find($id);

        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode     
        $method       = 'POST'; //method
        $timestamp    = Date('YmdHis');

        $body['product'][]       = 'Pendaftaran';
        $body['qty'][]           = 1;
        $body['price'][]         = 100000;
        $body['referenceId']     = 'ID-PPDB-'.rand(1111,9999);
        $body['returnUrl']       = route('callback.return');
        $body['notifyUrl']       = 'https://7724-139-192-164-152.ngrok-free.app/callback/notify';
        $body['cancelUrl']       = route('callback.cancel');
        $body['paymentChannel']  = 'qris';
        $body['expired']         = 24;
        $body['buyerName']       = $user->name;
        $body['buyerPhone']      = $user->phone;
        if ($user->email) {
            $body['buyerEmail']  = $user->email;
        }
        
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

    public function redirect_payment1($nama_product,$total, $id_tagihan)
    {
        $user         = Auth::user();

        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode     
        $method       = 'POST'; //method
        $timestamp    = Date('YmdHis');

        $body['product'][]       = $nama_product;
        $body['qty'][]           = 1;
        $body['price'][]         = $total;
        $body['referenceId']     = 'ID-PPDB-'.rand(1111,9999);
        $body['returnUrl']       = route('callback.return');
        $body['notifyUrl']       = 'https://7724-139-192-164-152.ngrok-free.app/callback/notify';
        $body['cancelUrl']       = route('callback.cancel');
        $body['paymentChannel']  = 'qris';
        $body['expired']         = 24;
        $body['buyerName']       = $user->name;
        $body['buyerPhone']      = $user->phone;
        if ($user->email) {
            $body['buyerEmail']  = $user->email;
        }
        
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
    public function redirect_payment2($nama_product, $total, $id_tagihan)
    {
        $user         = Auth::user();

        $va           = $this->va; //get on iPaymu dashboard
        $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode     
        $method       = 'POST'; //method
        $timestamp    = Date('YmdHis');

        $body['product'][]       = $nama_product;
        $body['qty'][]           = 1;
        $body['price'][]         = $total;
        $body['referenceId']     = 'ID-PPDB-'.rand(1111,9999);
        $body['returnUrl']       = route('callback.return');
        $body['notifyUrl']       = 'https://7724-139-192-164-152.ngrok-free.app/callback/notify';
        $body['cancelUrl']       = route('callback.cancel');
        $body['paymentChannel']  = 'qris';
        $body['expired']         = 24;
        $body['buyerName']       = $user->name;
        $body['buyerPhone']      = $user->phone;
        if ($user->email) {
            $body['buyerEmail']  = $user->email;
        }
        
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