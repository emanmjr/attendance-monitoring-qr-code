<?php
namespace App\Http\Traits;


trait MiddlewareApiTrait {


    protected $client; 
    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client(
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]
        );
    }
    
    // Get Access token from Middleware API
    public function getAccessToken() 
    {
        try {
            $res = $this->client->request(
                'POST',
                'http://3.1.170.158/mw/public/oauth/token', [
                'json' => [
                    "grant_type" => "password",
                    "username" => "AdminTool@test.com",
                    "password" => "6Nf&8C9lIyaws",
                    "client_id" => "6",
                    "client_secret" => "14WfCIBJLEcTLyHe9eA8hQxFs8I2I5h6fBvf423U",
                    "scope" => "*"
                ]
            ]);
        
        // Add to Session for Api Call purposes
        session()->put(
            'access_token', 
            json_decode($res->getBody()->getContents(), true)['access_token']
        );

        } catch (\Exception $ex) {
            \Log::error($ex);
        }

    }

}