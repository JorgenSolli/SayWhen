<?php

use App\Stores\KomplettStore;
use App\Stores\NetOnNetStore;

return [

    /*
    |--------------------------------------------------------------------------
    | Available stores
    |--------------------------------------------------------------------------
    |
    | List of stores that SayWhen can use.
    |
    */

    'list' => collect([
        new KomplettStore,
        new NetOnNetStore,
    ]),
];
