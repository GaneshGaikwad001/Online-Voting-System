<?php

	// Account details
	$apiKey = urlencode('NGM0YTZjNjkzNDM4Nzg2ODcwNTI1OTY5Mzk2ZDc3Nzk=');
	
	// Message details
	$numbers = array($_POST['mobile']);
	$sender = urlencode('TXTLCL');
    $otp = mt_rand(10000, 99999);
	$message = rawurlencode('This is your otp: '.$otp);
 
	$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
    
?>