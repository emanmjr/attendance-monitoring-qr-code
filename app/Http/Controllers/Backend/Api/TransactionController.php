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
            $res = $client->request('POST', 'http://3.1.170.158/mw/public/db-syncing/get-logs', [
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
            'my_wu_number' => 'required',
            'id_type' => 'required',
            'id_num' => 'required'
        ]);

        }

        if(request()->search_type_field == 'PHONE_NUMBER') {
            request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'my_wu_number' => 'required',
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
                "pfcFilter" => "FSA",
                "transactionType" => "SEND",
                "searchType" => "M",
                "firstName" => request()->first_name ? request()->first_name : "",
                "lastName" => request()->last_name ? request()->last_name : "",
                "myWuNumber" => request()->my_wu_number ? request()->my_wu_number : "",
                "idType" => request()->id_type ? request()->id_type : "",
                "idNum" => request()->id_num ? request()->id_num : "",
                "phoneNum" => request()->phone_num ? request()->phone_num : ""
            ];

            $res = $client->request('POST', 'http://3.1.170.158/mw/public/remittance/kyc', [
                'json' => $json
            ]);

   
            $xml = simplexml_load_string($res->getBody()->getContents());
            $namespaces = $xml->getNamespaces(true);
            $xml = $xml->children($namespaces['soapenv'])
                ->Body
                ->children($namespaces['NS1'])
                ->children();

            $response = json_encode($xml, true);

        } catch (ClientErrorResponseException $exception) {
            if($exception) {
                $this->getAccessToken();
            }
            $response = $exception->getResponse()->getBody(true);
        }

        return $response;
    }

}
