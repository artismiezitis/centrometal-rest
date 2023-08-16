<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StatusController extends CentrometalController
{
    public function index($installationId = [])
    {
        /*
         * If installation ID not set, receive default one
         */
        if(!$installationId)
        {
            $response = new InstallationController;
            $installationData = json_decode($response->index(), true);
            $installationId = [$installationData['installations'][0]['value']];
        }

        $response = $this->_response(config('centrometal.api.status'), [
            'installations' => $installationId
        ]);

        return $response->body();
    }
}
