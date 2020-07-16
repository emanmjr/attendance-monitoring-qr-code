<?php

namespace App\Http\Controllers\Backend\Api;

use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Http\Exception\ClientErrorResponseException;
use App\Http\Controllers\Controller;
use App\Http\Traits\MiddlewareApiTrait;

/**
 * Class DashboardController.
 */
class TransactionController extends Controller
{
    use MiddlewareApiTrait;
    /**
     * @return \Illuminate\View\View
     */
    public function getTransactions()
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);
   
        try {
            // $res = $client->request('POST', env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/db-syncing/get-logs', [
            $res = $client->request('POST', 'http://3.1.170.158/mw_v1008/public/db-syncing/get-logs', [
                'form_params' => [
                    'date' => request()->dateTransaction
                ]
            ]);
            $response = json_decode($res->getBody()->getContents(), true);

        } catch (ClientErrorResponseException $exception) {
            $res = $exception->getResponse()->getBody(true);
        }

        return $response;

    }

    public function kycLookUp()
    {
        if(request()->search_type_field == 'COMPLIANCE_ID') {
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // 'my_wu_number' => 'required',
                'id_type' => 'required',
                'id_num' => 'required'
            ]);

        }

        if(request()->search_type_field == 'PHONE_NUMBER') {
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // 'my_wu_number' => 'required',
                'phone_num' => 'required'
            ]);
        }

        if(request()->search_type_field == 'MYWU_Number') {
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'my_wu_number' => 'required',
            ]);
        }

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        try {

            $json = [
                "searchParameter" => request()->search_type_field,
                "channelType" => "H2H",
                "channelVersion" => "9500",
                "pfcFilter" => request()->search_type_field == "MYWU_NUMBER" ? "FSA" : "WPM",
                "transactionType" => "SEND",
                "searchType" => request()->search_type_field == "MYWU_NUMBER" ? "S" : "M",
                "firstName" => request()->first_name ? request()->first_name : "",
                "lastName" => request()->last_name ? request()->last_name : "",
                "myWuNumber" => request()->my_wu_number ? request()->my_wu_number : "",
                "idType" => request()->id_type ? request()->id_type : "",
                "idNum" => request()->id_num ? request()->id_num : "",
                "phoneNum" => request()->phone_num ? request()->phone_num : ""
            ];

            // request()->single_multifind

            
            // $res = $client->request('POST', env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/remittance/kyc', [
            $res = $client->request('POST', 'http://3.1.170.158/mw_v1008/public/remittance/kyc', [
                'json' => $json
            ]);

   
            $xml = simplexml_load_string($res->getBody()->getContents());
            
            $namespaces = $xml->getNamespaces(true);
            $arrayXmlResponse = json_decode(json_encode($xml->children($namespaces['soapenv'])->Body), true);
            if(array_key_exists("Fault", $arrayXmlResponse)){
                $xml = $xml->children($namespaces['soapenv'])
                ->Body
                ->Fault
                ->children();

                $response = json_encode($xml, true);
            } else {
                $xml = $xml->children($namespaces['soapenv'])
                ->Body
                ->children($namespaces['NS1'])
                ->children();

                $response = json_encode($xml, true);
            }

            

        } catch (ClientErrorResponseException $exception) {
            $response = $exception->getResponse()->getBody(true);
        }

        return $response;
    }

    public function payStatus()
    {
        request()->validate([
            'mtcn' => 'required',
            'recording_country_code' => 'required',
            'recording_currency_country_code' => 'required',
            'pay_wo_indicator' => 'required',
        ]);

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' =>  session()->get('access_token')
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);

        try {

            $json = [
                "channelType" =>  "H2H",
                "channelVersion" =>  "9500",
                "recordingCountryCode" =>  request()->recording_country_code,
                "recordingCountryCurrencyCode" =>  request()->recording_currency_country_code,
                "mtcn" => request()->mtcn,
                "payWoIdIndicator" => request()->pay_wo_indicator
            ];
            
            // $res = $client->request('POST', env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/remittance/kyc', [
            $res = $client->request('POST', 'http://3.1.170.158/mw_v1008/public/remittance/status', [
                'json' => $json
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
