<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class InstallationController extends Controller
{
    public function index()
    {
        $response = Http::withOptions([
            'cookies' => config('centrometal.cookies')
        ])->post(config('centrometal.api.installation'));

        return $response->body();
    }
}
