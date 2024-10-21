<?php

return [

    'captcha' => [

        'default' => env('RECRUITMENT_CAPTCHA', 'math')

    ],

    'storage'=>[
        'disk'=>'recruitment',
    ]

];