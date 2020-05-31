<?php

namespace App\Http\Controllers\Backend\Api;

use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Http\Exception\ClientErrorResponseException;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class MyWUController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function enrollCustomer()
    {
        request()->validate([
            'country_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone_number' => 'required',
            'postal_code' => 'required',
            'currency_code' => 'required',
            'destination_country_code' => 'required',
            'destination_currency_code' => 'required',
            'sender_currency_code' => 'required'
        ]);

        
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);
   
        try {
            $res = $client->request('POST', 'http://3.1.170.158/mw/public/remittance/mywu', [
                'json' => [
                    "Category" =>"Enroll",
                    "countryCode" => request()->country_code,
                    "firstName" => request()->first_name,
                    "lastName" => request()->last_name,
                    "address" => request()->address,
                    "city" => request()->city,
                    "phoneNum" => request()->phone_number,
                    "postalCode" => request()->postal_code,
                    "currencyCode" => request()->currency_code,
                    "destinationCountryCode" => request()->destination_country_code,
                    "destinationCurrencyCode" => request()->destination_currency_code,
                    "senderCurrencyCode" => request()->sender_currency_code
                ]
            ]);
   
            $xml = simplexml_load_string($res->getBody()->getContents());
            $namespaces = $xml->getNamespaces(true);
            $xml = $xml->children($namespaces['soapenv'])
                ->Body
                ->children($namespaces['xrsi'])
                ->children();

            $response = json_encode($xml, true);

        } catch (ClientErrorResponseException $exception) {
            $response = $exception->getResponse()->getBody(true);
        }

        return $response;

    }
}
