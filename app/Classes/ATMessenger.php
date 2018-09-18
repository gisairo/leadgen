<?php
namespace App\Classes;

use AfricasTalking\SDK\AfricasTalking;

/**
 * Handles sms sending via Afristalking Api
 */
class ATMessenger
{
	
	// $gateway;
	private $gateway;

	function __construct()
	{
		$username = env('ATUSERNAME', 'sandbox');
		$apiKey = env('ATAPIKEY');
		$this->gateway = new AfricasTalking($username, $apiKey, "sandbox");
	}

	public function sendMessage($recipients, $message)
	{
		$shortcode = env('ATSHORTCODE','10040');
		// Thats it, hit send and we'll take care of the rest. 
		$sms = $this->gateway->sms();
		$options = [
			'to' => $recipients,
			'message' => $message,
			'from' => $shortcode
		];
		$results = $sms->send($options);
		// dd($results);            
		return $results;
		
	}

}