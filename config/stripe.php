<?php

return [
    'publish_key' => env('STRIPE_PUBLISH_KEY'),
    'secret_key' => env('STRIPE_SECRET_KEY'),
    'secret_signature' => env('STRIPE_WEBHOOK_SECRET'),
];
