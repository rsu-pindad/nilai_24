<?php

return [
    /*
    |----------------------------------------------------------------------------
    | Google application name
    |----------------------------------------------------------------------------
    */
    'application_name' => env('GOOGLE_APPLICATION_NAME', ''),

    /*
    |----------------------------------------------------------------------------
    | Google OAuth 2.0 access
    |----------------------------------------------------------------------------
    |
    | Keys for OAuth 2.0 access, see the API console at
    | https://developers.google.com/console
    |
    */
    'client_id' => env('GOOGLE_CLIENT_ID', ''),
    'client_secret' => env('GOOGLE_CLIENT_SECRET', ''),
    'redirect_uri' => env('GOOGLE_REDIRECT', ''),
    'scopes' => [\Google\Service\Sheets::DRIVE, \Google\Service\Sheets::SPREADSHEETS],
    'access_type' => 'offline',
    'approval_prompt' => 'force',
    'prompt'           => 'consent', //"none", "consent", "select_account" default:none

    /*
    |----------------------------------------------------------------------------
    | Google developer key
    |----------------------------------------------------------------------------
    |
    | Simple API access key, also from the API console. Ensure you get
    | a Server key, and not a Browser key.
    |
    */
    'developer_key' => env('GOOGLE_DEVELOPER_KEY', ''),

    /*
    |----------------------------------------------------------------------------
    | Google service account
    |----------------------------------------------------------------------------
    |
    | Set the credentials JSON's location to use assert credentials, otherwise
    | app engine or compute engine will be used.
    |
    */
    'service' => [
        /*
        | Enable service account auth or not.
        */
        'enable' => env('GOOGLE_SERVICE_ENABLED', true),

        /*
         * Path to service account json file. You can also pass the credentials as an array
         * instead of a file path.
         */
        'file' => storage_path(env('GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION', 'app/assessment-414801-850ff85712e2.json')),
    ],

    /*
    |----------------------------------------------------------------------------
    | Additional config for the Google Client
    |----------------------------------------------------------------------------
    |
    | Set any additional config variables supported by the Google Client
    | Details can be found here:
    | https://github.com/google/google-api-php-client/blob/master/src/Google/Client.php
    |
    | NOTE: If client id is specified here, it will get over written by the one above.
    |
    */
    'config' => [
        'sheet_dp_2024_id' => env('GOOGLE_SHEET_ID',''),
        'sheet_response_link' => env('GOOGLE_SHEET_RESPONSE_LINK', ''),
        'sheet_response_id' => env('GOOGLE_SHEET_RESPONSE_ID', ''),
        'sheet_response_name' => env('GOOGLE_SHEET_RESPONSE_NAME', ''),

        'sheet_dp_2023_id' => env('GOOGLE_SHEET_DP_2023_ID', ''),
        'sheet_dp_2023_name' => env('GOOGLE_SHEET_DP_2023_NAME', ''),
        'fonnte' => env('FONNTE_TOKEN', ''),
    ],
];
