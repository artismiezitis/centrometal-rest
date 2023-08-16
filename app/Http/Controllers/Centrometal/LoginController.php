<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function index()
    {
        $client = new Client();

        $response = $client->get(config('centrometal.api.home'));
        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

        $csrfInput = $crawler->filter('input[name="_csrf_token"]')->first();

        $cookies = $response->getHeader('Set-Cookie');

        $pattern = '/PHPSESSID=([^;]+)/';
        preg_match($pattern, $cookies[0], $matches);
        $PHPSESSID = $matches[1];

        $client->post(config('centrometal.api.login'), [
            'cookies' => CookieJar::fromArray([
                'PHPSESSID' => $matches[1]
            ], config('centrometal.api.domain')),
            'form_params' => [
                '_csrf_token' => $csrfInput->attr('value'),
                '_username' => config('centrometal.username'),
                '_password' => config('centrometal.password')
            ],
        ]);


        if (Storage::disk('local')->exists(config('centrometal.cookie_path'))) {
            Storage::disk('local')->delete(config('centrometal.cookie_path'));
        }

        return $PHPSESSID;

    }
}
