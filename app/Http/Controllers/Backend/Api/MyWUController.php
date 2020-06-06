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
                    "channelType" => "H2H",
                    "channelVersion" => "9500",
                    "countryCode" => request()->country_code,
                    "firstName" => request()->first_name,
                    "lastName" => request()->last_name,
                    "address" => request()->address,
                    "city" => request()->city,
                    "phoneNum" => request()->phone_number,
                    "postalCode" => request()->postal_code,
                    "gender" => request()->gender,
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

    public function dasRequest()
    {

        request()->validate([
            'das_request_type' => 'required',
        ]);

    
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        $queryFilters = [
            'queryFilter1' => $this->queryFilter1TypeRequest(request()),
            'queryFilter2' => $this->queryFilter2TypeRequest(request()),
        ];

        $json = $this->buildData(request(), $queryFilters);
        
        try {
            $res = $client->request('POST', 'http://3.1.170.158/mw/public/remittance/send', [
                'json' => $json
            ]);

            $xml = simplexml_load_string($res->getBody()->getContents());
            $namespaces = $xml->getNamespaces(true);
            $xml = $xml->children($namespaces['soapenv'])
                    ->Body
                    ->children($namespaces['xrsi'])
                    ->children()
                    ->MTML
                    ->REPLY
                    ->DATA_CONTEXT
                    ->RECORDSET;

            $response = json_encode($xml, true);

        } catch (ClientErrorResponseException $exception) {
            $response = $exception->getResponse()->getBody(true);
        }

        return $response;
    }

    public function queryFilter1TypeRequest($request)
    {
        if($request->das_request_type == 'GetCountriesCurrencies'){
            return $request->queryFilter1;
        }

        if($request->das_request_type == 'GetCountryInfo'){
            return $request->queryFilter1;
        }

        if($request->das_request_type == 'GetDeliveryServices'){
            return $request->queryFilter1;
        }

        if($request->das_request_type == 'GetDeliveryOptionTemplate'){
            return $request->queryFilter1;
        }

        if($request->das_request_type == 'GetCascadeList'){
            return "CMBSRI";
        }

        if($request->das_request_type == 'GetMexicoCityState'){
            return "";
        }

        if($request->das_request_type == 'GetStateList'){
            return explode(" ",$request->queryFilter1)[0];
        }
        
    }

    public function queryFilter2TypeRequest($request)
    {
        if($request->das_request_type == 'GetCountriesCurrencies'){
            return $request->queryFilter2;
        }

        if($request->das_request_type == 'GetCountryInfo'){
            return $request->queryFilter2;
        }

        if($request->das_request_type == 'GetDeliveryServices'){
            return $request->queryFilter2;
        }

        if($request->das_request_type == 'GetDeliveryOptionTemplate'){
            return "4200";
        }

        if($request->das_request_type == 'GetCascadeList'){
            return "";
        }

        if($request->das_request_type == 'GetMexicoCityState'){
            return "";
        }

        if($request->das_request_type == 'GetStateList'){
            return "";
        }

        
    }

    public function buildData($request, $queryFilters)
    {
        if($request->das_request_type == 'GetCountriesCurrencies'){
            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => $request->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
                // "queryFilter2" => $request->queryFilter2,
                // "queryFilter3" => $request->queryFilter3,
                // "queryFilter4" => $request->queryFilter4,
                // "queryFilter5" => $request->queryFilter5,
            ];
        }

        if($request->das_request_type == 'GetCountryInfo'){
            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => $request->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
                // "queryFilter2" => $request->queryFilter2,
                // "queryFilter3" => $request->queryFilter3,
                // "queryFilter4" => $request->queryFilter4,
                // "queryFilter5" => $request->queryFilter5,
            ];
        }


        if($request->das_request_type == 'GetDeliveryServices'){

            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => request()->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
                "queryFilter2" => strtoupper($queryFilters['queryFilter2']),
                "queryFilter3" => "ALL",
            ];
        }

        if($request->das_request_type == 'GetDeliveryOptionTemplate'){

            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => request()->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
                "queryFilter2" => "4200",
            ];
        }

        if($request->das_request_type == 'GetCascadeList'){

            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => request()->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
            ];
        }

        if($request->das_request_type == 'GetMexicoCityState'){

            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => request()->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
                "queryFilter2" => strtoupper($queryFilters['queryFilter2']),
            ];
        }

        if($request->das_request_type == 'GetStateList'){

            return [
                "Category" =>"Das",
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "dasRequest" => $request->das_request_type,
                "accountNum" => request()->accout_number,
                "queryFilter1" => strtoupper($queryFilters['queryFilter1']),
            ];
        }

        
    }
}
