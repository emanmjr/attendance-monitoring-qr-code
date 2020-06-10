<?php

namespace App\Http\Controllers\Backend\Api;

use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Http\Exception\ClientErrorResponseException;
use App\Http\Controllers\Controller;

use App\Models\DasRequestStorage;

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
            $res = $client->request('POST', env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/remittance/mywu', [
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

        // Setting Headers
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        // Validate Request
        request()->validate([
            'das_request_type' => 'required',
        ]);


        // Prepare need filter params for different kind of type request
        $queryFilters = [
            'queryFilter1' => $this->queryFilter1TypeRequest(request()),
            'queryFilter2' => $this->queryFilter2TypeRequest(request()),
        ];


        // Build Data for requesting api
        $json = $this->buildData(request(), $queryFilters);



        // Check type if type of request is already in DB
        $response = $this->checkIfAlreadyStored($json);
        
        if(!$response) {

            // RESPONSE
            $response = $this->requestToMiddleware($client, $json);

            $dasRequest = new DasRequestStorage();
            $dasRequest->type_of_request = $json['dasRequest'];
            $dasRequest->filters = json_encode($json);
            $dasRequest->data = json_encode($response);
            $dasRequest->save();

        }

        if(!isset($dasRequest)){

            // Check query filter if already exist
            $response = $this->checkFilters($response, $json);
    
            if (!$response){

                // RESPONSE
                $response = $this->requestToMiddleware($client, $json);

                $dasRequest = new DasRequestStorage();
                $dasRequest->type_of_request = $json['dasRequest'];
                $dasRequest->filters = json_encode($json);
                $dasRequest->data = json_encode($response);
                $dasRequest->save();

            } else {
                $response = $this->decodeStoredData($response);
            }

        }

        return $response;
        
    }


    public function requestToMiddleware($client, $json)
    {
        try {
            $res = $client->request('POST', env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/remittance/send', [
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

            return json_encode($xml, true);

        } catch (ClientErrorResponseException $exception) {
            return $exception->getResponse()->getBody(true);
        }

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

    public function checkIfAlreadyStored($data)
    {
        $dasRequestStorages = DasRequestStorage::where('type_of_request', $data['dasRequest'])->get();
        
        if ( count($dasRequestStorages) == 0) return false;

        return $dasRequestStorages->toArray();
    }

    public function checkFilters($data, $jsonData)
    {
        foreach($data as $key => $value){
            // Check if filters same with jsonData
            if (json_decode($value['filters'], true) == $jsonData){
                if(!\Carbon\Carbon::parse($value['created_at'])->isToday()) {
                    DasRequestStorage::find($value['id'])->delete();
                    return false;
                }

                return $value;
            }
        }

        // No Data Store found
        return false;

    }

    public function decodeStoredData($response)
    {
        return json_decode($response['data'], true);
    }
}