<?php

/**
 * Configuration file for PersiaFava SMS SDK.
 * This file should be published to the main config/ directory of a Laravel application.
 */

return [

    /**
     * ESB V2 Authentication String
     * This is the Basic Authentication string.
     * It's recommended to retrieve this from your .env file.
     * Example: env('SMS_ESB_AUTH_STRING', 'YOUR_AUTH_STRING_HERE')
     */
    'auth_string' => env('SMS_ESB_AUTH_STRING'),

    /**
     * Guzzle Client Timeout
     * Default request timeout in seconds.
     */
    'timeout' => 5.0,

    /**
     * ESB V2 Base URIs
     * Base URLs for the different ESB V2 microservices.
     * The SDK will append the specific endpoints (e.g., /PeerToPeer, /Bulk).
     */
    'base_uri_esbv2' => [
        'p2p'          => env('SMS_ESB_URI_P2P', 'https://sms.persiafava.com:3000'),
        'bulk'         => env('SMS_ESB_URI_BULK', 'https://sms.persiafava.com:3001'),
        'otp'          => env('SMS_ESB_URI_OTP', 'https://sms.persiafava.com:3002'),
        'delivery'     => env('SMS_ESB_URI_DELIVERY', 'https://sms.persiafava.com:3003'),
        'receive_list' => env('SMS_ESB_URI_RECEIVE_LIST', 'https://sms.persiafava.com:3004'),
        'receive_read' => env('SMS_ESB_URI_RECEIVE_READ', 'https://sms.persiafava.com:3005'),
        'user_info'    => env('SMS_ESB_URI_USER_INFO', 'https://sms.persiafava.com:3006'),
    ],

    /**
     * ESB 1.5 Configuration (Legacy)
     * Configuration for the older ESB 1.5 API (port 7074).
     */
    // 'auth_string_esb1_5' => env('SMS_ESB1_5_AUTH_STRING'),
    // 'base_uri_esb1_5' => 'https://sms.persiafava.com:7074/api/v1/sms/send/3000',

];
