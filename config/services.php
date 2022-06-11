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
        'client_id' => '910825108964-b7f2k71c4bdqvcme9gure4ccod21gvt3.apps.googleusercontent.com', //USE FROM Google DEVELOPER ACCOUNT
        'client_secret' => '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', //USE FROM Google DEVELOPER ACCOUNT
        'redirect' => 'https://nyomozoo.hu/google/callback/'
    ],
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_V2_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_V2_SECRET_KEY'),
    ],
];
