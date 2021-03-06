<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Header Key
    |--------------------------------------------------------------------------
    |
    | This is the name of the variable that will provide us the API key in the
    | header
    |
    */
    'header_key' => 'X-Authorization',

    'models' => [

        'api_key' => \App\Models\ApiKey::class,

    ],

];
