<?php

return [

    'auth' => [

        'middleware' => [],

    ],

    'captcha' => [

        'default' => env('RECRUITMENT_CAPTCHA', 'math')

    ],

    'storage'=>[

        'disk'=>'recruitment',

    ],

];