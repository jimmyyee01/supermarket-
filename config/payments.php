<?php
// config/payments.php
return [
    'stripe' => ['secret_key'=>'sk_test_...', 'public_key'=>'pk_test_...'],
    'flutterwave' => ['secret_key'=>'FLWSECK-...', 'public_key'=>'FLWPUBK-...'],
    'paystack' => ['secret_key'=>'sk_test_...', 'public_key'=>'pk_test_...'],
    'mtn_momo' => ['subscription_key'=>'', 'api_user'=>'', 'api_key'=>'', 'environment'=>'sandbox'],
    'airtel_money' => ['client_id'=>'', 'client_secret'=>'', 'environment'=>'sandbox'],
];
