<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Cookie\CookieJar;

class UserController extends Controller
{
    public function index($userId = null)
    {
        /*
         * If installation ID not set, receive default one
         */
        if(!$userId)
        {
            $response = new InstallationDataController();
            $installationData = json_decode($response->index(), true);
            $userId = $installationData['owner'];
        }

        $response = Http::withOptions([
            'cookies' => config('centrometal.cookies'),
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ])->post(config('centrometal.api.user').$userId);

        return $response->body();
    }
}
