<?php

use GuzzleHttp\Cookie\CookieJar;

return [
    'cookies' => CookieJar::fromArray([
        'PHPSESSID' => env('CENTROMETAL_SESSION_ID')
    ], 'portal.centrometal.hr'),

    'api' => [
        'domain' => 'portal.centrometal.hr',
        'installation' => 'https://portal.centrometal.hr/data/autocomplete/installation',
        'installation_data' => 'https://portal.centrometal.hr/installations/data/',
        'status' => 'https://portal.centrometal.hr/wdata/data/installation-status-all',
        'wdata_parameter_list' => 'https://portal.centrometal.hr/wdata/data/parameter-list/',
        'user' => 'https://portal.centrometal.hr/users/data/',
        'errors' => 'https://portal.centrometal.hr/wdata/data/multi/errors-list/'
    ]
];
