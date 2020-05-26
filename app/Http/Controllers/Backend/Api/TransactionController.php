<?php

namespace App\Http\Controllers\Backend\Api;

use GuzzleHttp\Client as GuzzleClient;
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
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMyYzI5OWM1MWMxNGE1YWE4ODdiNjUwM2QyZDk0ZGYwYjg3NGFlMjM4YWY2MTlkZTNmMWIyNWNkYzc2NWRjOTEzODBmZGZjZGE0ZTFkMTg1In0.eyJhdWQiOiI2IiwianRpIjoiMzJjMjk5YzUxYzE0YTVhYTg4N2I2NTAzZDJkOTRkZjBiODc0YWUyMzhhZjYxOWRlM2YxYjI1Y2RjNzY1ZGM5MTM4MGZkZmNkYTRlMWQxODUiLCJpYXQiOjE1OTA0NzI1MTAsIm5iZiI6MTU5MDQ3MjUxMCwiZXhwIjoxNjIyMDA4NTEwLCJzdWIiOiI2Iiwic2NvcGVzIjpbIioiXX0.RKkgw_-qHnPtRiF8O_Xt3wQHjPTHwnAj0Okh8SMx9-GqwtKej8dTnzqK0QJDI1Mt7qHvgqWa9h3Ba1V2hwZlHFs21dGOavtD8G9xzRsPGLeg3My9j4LxY0xPIs1qif-pV37uSjMwGPATt9NVBRna19WaGuV8F-NEocZVUdjlPU3FQ5stlNm7x1L8Ze38iyMODF4BA2bbJWl4NsTVn8BydWe2fSnxV9mUNdL9Hq2XTurfIBTSVX2-N8ndj9PJOFgbwRE7W-Iwku1LnQSvP5ZhR-2b1Np1HBGQF9J96sD9I67yhp_lgqjV4ylxXszCkwzCou1nx81Ry4TRSq4HdZaqzpQEvv0HbB2x9lagZmRaof-IcZ8yh-vtMYvonQvtCgS7IpE92GcIWTocSV1pLM8oIMckS1tZcMCMGaCtDbsn9NHuxtZZ2Xnii5CSrgjKezaZtIAXZKj4I61WtlzC5n2r0NNnu8W7KBWAmrDahW23uavcN_wOTErTwfF_OGfHsSNkWKHPCSGqrL-ErTcnTjebc3yLYARvcmG01sHfxR4osZPltSaIPmVy9UEPAzqq_NQCNybaJKkXKk2Ks5WhIZMczM1VPI85kx1KLNswIifET45Rdk0MSSOTE_YUHLqJMAySEQhXkQ4OsAaatnW8Eu8rfdJ0Y-is-nCvf8FpyiMQA1E',
        ];
        
        $client = new GuzzleClient([
            'headers' => $headers
        ]);
   
        $r = $client->request('POST', 'http://3.1.170.158/mw/public/db-syncing/get-logs', [
            'form_params' => [
                'date' => '2020-05-26'
            ]
        ]);
        $response = json_decode($r->getBody()->getContents(), true);


        return $response;

    }
}
