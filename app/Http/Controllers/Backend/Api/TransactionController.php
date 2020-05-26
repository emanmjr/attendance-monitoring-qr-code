<?php

namespace App\Http\Controllers\Backend\Api;

use GuzzleHttp\Client as GuzzleClient;
use Guzzle\Http\Exception\ClientErrorResponseException;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class TransactionController extends Controller
{
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
                    'date' => '2020-05-26'
                ]
            ]);
            $response = json_decode($res->getBody()->getContents(), true);

        } catch (ClientErrorResponseException $exception) {
            $res = $exception->getResponse()->getBody(true);
        }
        


        return $response;

    }
}
