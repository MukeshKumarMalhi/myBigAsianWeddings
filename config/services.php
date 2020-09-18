<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '980507452211-ebp7gqd1rvcliqpgvjpv859rcgkoeggt.apps.googleusercontent.com',
        'client_secret' => 'BG2HVZ8KJA-JbX-r1Lbrx_Oi',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ],

    'facebook' => [
        'client_id' => '260174641972845',
        'client_secret' => '2c9ac589a14fbfbf6cbd95f9dcfce4cb',
        'redirect' => 'http://127.0.0.1:8000/callback/facebook',
    ],

];
