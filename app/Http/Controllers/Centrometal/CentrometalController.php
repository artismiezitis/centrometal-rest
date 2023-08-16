<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Cookie\CookieJar;

class CentrometalController extends Controller
{

    protected function _response($path, $params = [], $headers = [], $method = 'post')
    {
        $headers = $headers + [
            'Content-Type' => 'application/json'
        ];

        $session = new AuthCookieController;


        return Http::withOptions([
            'cookies' => CookieJar::fromArray([
                'PHPSESSID' => $session->index()
            ], 'portal.centrometal.hr'),
            'headers' => $headers,
        ])->$method($path, $params);
    }
}
