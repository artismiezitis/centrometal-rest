<?php

use GuzzleHttp\Cookie\CookieJar;

return [
    'username' => env('CENTROMETAL_USERNAME'),
    'password' => env('CENTROMETAL_UPASSWORD'),

    'cookie_path' => 'centrometal_cookie.txt',
    'cookie_renew' => 60,

    'api' => [
        'domain' => 'portal.centrometal.hr',
        'installation' => 'https://portal.centrometal.hr/data/autocomplete/installation',
        'installation_data' => 'https://portal.centrometal.hr/installations/data/',
        'status' => 'https://portal.centrometal.hr/wdata/data/installation-status-all',
        'wdata_parameter_list' => 'https://portal.centrometal.hr/wdata/data/parameter-list/',
        'user' => 'https://portal.centrometal.hr/users/data/',
        'errors' => 'https://portal.centrometal.hr/wdata/data/multi/errors-list/',
        'login' => 'https://portal.centrometal.hr/login_check',
        'home' => 'https://portal.centrometal.hr/login'
    ]
];
