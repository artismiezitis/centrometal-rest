<?php

namespace App\Http\Controllers\Centrometal;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AuthCookieController extends Controller
{
    public function index()
    {
        $data = Storage::disk('local')->get(config('centrometal.cookie_path'));
        $data = json_decode($data, true);

        if ($data && isset($data['value']) && isset($data['expiration'])) {
            $expiration = Carbon::parse($data['expiration']);

            if ($expiration->isFuture()) return $data['value'];
        }

        $LoginCookie = new LoginController;
        $cookieValue = $LoginCookie->index();

        $expiration = Carbon::now()->addMinutes(config('centrometal.cookie_renew'));

        $dataToStore = [
            'value' => $cookieValue,
            'expiration' => $expiration->toDateTimeString(),
        ];

        Storage::disk('local')->put(config('centrometal.cookie_path'), json_encode($dataToStore));

        return $cookieValue;
    }
}
