<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class WdataController extends Controller
{
    public function index($serialNumber = null)
    {
        if(!$serialNumber)
        {
            $response = new InstallationDataController();
            $installationData = json_decode($response->index(), true);
            $serialNumber = $installationData['serialNumber'];
        }

        $response = Http::withOptions([
            'cookies' => config('centrometal.cookies'),
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ])->post(config('centrometal.api.wdata_parameter_list').$serialNumber);

        return $response->body();
    }
}
