<?php
session_start();
require '../vendor/autoload.php';

$stripe = new \Stripe\StripeClient(
  'sk_test_51JD39iBFyu0HK0eBNM1RiCUhzIKwmnwYv3vN21Jc92nDsUcmfo3beRnJDkLYgaXZ8Q4JHGxmhP0HrgshAhYOXfVE00298mHjRg'
);

header('Content-Type: application/json');
$productName = $_POST['product_name'];

$YOUR_DOMAIN = 'http://localhost:8000/src';

$checkout_session = $stripe->checkout->sessions->create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => 2000,
      'product_data' => [
        'name' => $productName,
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'customer_email' => 'user@email.com',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);


$_SESSION['email'] = $checkout_session->customer_email;

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);