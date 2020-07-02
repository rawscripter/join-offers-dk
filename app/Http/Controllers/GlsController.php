<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;

class GlsController extends Controller
{
    public function getShops(Request $request)
    {
        $city = $request->city;
        $zip = $request->zip_code;
        $address = $request->address;
        $amount = "4000";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'www.gls.dk/webservices_v4/wsShopFinder.asmx/GetParcelShopsInZipcode', [
            'body' => 'street=' . $address . '&zipcode=' . $zip . '&countryIso3166A2=dk&Amount=' . $amount . '',
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        $xml = $response->getBody();


        $xml = new SimpleXMLElement($xml);

        $json = json_encode($xml);
        return $json;
    }
}
