<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/class-db.php';

define('GOOGLE_CLIENT_ID', '643448513411-s3acf0he8cjqkjcqjmicr067ns6m1h46.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'http://localhost:82/callback.php',
    'keys'     => [
                    'id' => GOOGLE_CLIENT_ID,
                    'secret' => GOOGLE_CLIENT_SECRET
                ],
    'scope'    => 'https://mail.google.com',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];

$adapter = new Hybridauth\Provider\Google($config);
  
