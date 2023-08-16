<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InstallationController extends CentrometalController
{
    public function index()
    {

        $response = $this->_response(config('centrometal.api.installation'));

        return $response->body();
    }
}
