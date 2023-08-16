<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InstallationDataController extends CentrometalController
{
    public function index($installationId = null)
    {
        /*
         * If installation ID not set, receive default one
         */
        if(!$installationId)
        {
            $response = new InstallationController;
            $installationData = json_decode($response->index(), true);
            $installationId = $installationData['installations'][0]['value'];
        }

        $response = $this->_response(config('centrometal.api.installation_data').$installationId);

        return $response->body();
    }
}
