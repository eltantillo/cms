<?php
include('paypal/autoload.php');

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

function checkout($id, $product, $price, $url){
	$successUrl = $url . '/compras/' . $id . '/?payment=' . $id . '&success=' . urlencode('¡Su compra se ha realizado con éxito!');
	$failureUrl = $url . '/compras/' . $id . '/';

	$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		'Ackl23n2NnMAgEX_Lysi_lJR4kvWTh7ay8XIdaoSE_bfeQI0uLPaERvf64-4vP5Dm7fTBy8Icso8o-JS',
		'ECzES10TucBQByjnVKOClaKlBQw3pgUgIpPPprYG2znpx3HTTIJ220_qp9jGotvVfz6XiHJEYXAdbNwu'
		)
	);

	$paypal->setConfig(
		array(
			'mode' => 'live',
			'log.LogEnabled' => false,
			'cache.enabled' => true,
		)
	);

	$payer = new Payer();
	$payer->setPaymentMethod('paypal');

	$item = new Item();
	$item->setName($product)
		 ->setCurrency('USD')
		 ->setQuantity(1)
		 ->setPrice($price);

	$itemList = new ItemList();
	$itemList->setItems([$item]);

	$details = new Details();
	$details->setSubtotal($price);

	$amount = new Amount();
	$amount->setCurrency('USD')
		   ->setTotal($price)
		   ->setDetails($details);

	$transaction = new Transaction();
	$transaction->setAmount($amount)
				->setItemList($itemList)
				->setDescription('Acceso al material')
				->setInvoiceNumber(uniqid());

	$redirectUrls = new RedirectUrls();
	$redirectUrls->setReturnUrl($successUrl)
				 ->setCancelUrl($failureUrl);

	$payment = new Payment();
	$payment->setIntent('sale')
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

	try {
		$payment->create($paypal);
	} catch (Exception $e) {
		die($e);
	}

	$approvalUrl = $payment->getApprovalLink();

	header("Location: {$approvalUrl}");
}

function process($paymentID, $payerID){
	$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential(
		'Ackl23n2NnMAgEX_Lysi_lJR4kvWTh7ay8XIdaoSE_bfeQI0uLPaERvf64-4vP5Dm7fTBy8Icso8o-JS',
		'ECzES10TucBQByjnVKOClaKlBQw3pgUgIpPPprYG2znpx3HTTIJ220_qp9jGotvVfz6XiHJEYXAdbNwu'
		)
	);

	$paypal->setConfig(
		array(
			'mode' => 'live',
			'log.LogEnabled' => true,
			'log.FileName' => '../PayPal.log',
			'log.LogLevel' => 'DEBUG',
			'validation.level' => 'log',
			'cache.enabled' => true,
		)
	);

	$payment = Payment::get($paymentID, $paypal);
	$execute = new PaymentExecution();
	$execute->setPayerId($payerID);

	try {
		$result = $payment->execute($execute, $paypal);
	} catch (Exception $e) {
		$data = json_decode($e->getData());
		echo $data->message;
		return false;
	}

	return true;
}
?>