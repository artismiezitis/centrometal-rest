<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Cookie\CookieJar;

class UserController extends CentrometalController
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

        $response = $this->_response(config('centrometal.api.user').$userId);

        return $response->body();
    }
}
