<?php

namespace App\Http\Repositories;

use App\CriptoInterfaceRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Number;

class CriptoRepository implements CriptoInterfaceRepository
{

    public function getResponseApiBitcoin()
    {
        $url = env('API_BITCOIN');
        $response = Http::get($url);
        $bits = $response->json('results.bitcoin');
        $bits = collect($bits)->map(function ($bit) {
        $value = $bit['format'][0] === 'BRL' 
                ? $bit['last'] 
                : $this->convertDollarToReais($bit['last']);
                
            $bit['formatted_price'] = $value;
            return $bit;
        });

        return $bits;
    }
    public function getResponseApiDollar()
    {
        $url = env('API_DOLLAR');
        $response = Http::get($url);
        $dollar = $response->json('results.currencies.USD.sell');
        
        return $dollar;
    }
    public function convertDollarToReais(float $value)
    {
        return $value * $this->getResponseApiDollar();
    }
}