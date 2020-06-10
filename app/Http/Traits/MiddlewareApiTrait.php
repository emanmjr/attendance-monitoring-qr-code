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
                env('MIDDLEWARE_URL_ENVIRONMENT') . '/public/oauth/token', [
                'json' => [
                    "grant_type" => "password",
                    "username" => env('MIDDLEWARE_API_USERNAME'),
                    "password" => env('MIDDLEWARE_API_PASSWORD'),
                    "client_id" => env("MIDDLEWARE_API_CLIENT_ID"),
                    "client_secret" => env("MIDDLEWARE_API_CLIENT_SECRET"),
                    "scope" => "*"
                ]
            ]);

        return json_decode($res->getBody()->getContents(), true)['access_token'];

        } catch (\Exception $ex) {
            \Log::error($ex);
        }

    }

}