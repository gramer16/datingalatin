<?php

require_once('stripe-php/init.php');
\Stripe\Stripe::setApiKey('pk_test_7KdrFyzK2hIp4xG3FtFWIMzD');

$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$name = $_POST['name'];
$email = $_POST['email'];

try {
	$charge = \Stripe\Charge::create(array(
	"amount" => $amount,
	"currency" => "usd",
	"source" => $token,)
	);
	
	mail("graciam@dngglobal.ca", "Subscription Done", "amount:$amount, name:$name, email:$email");
	
	$json = array(
	'completion' => 'done'
	);
	
	echo json_encode($json);
	
	} catch(\Stripe\Error\Card $e) {
		$errorMessage = $e -> getMessage();
		$json = array(
	'completion' => $errorMessage
	);
	echo json_encode($json);
		}




?>