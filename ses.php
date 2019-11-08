<?php
	//Install and initialize AWS SDK
	require 'AWSSDK/aws-autoloader.php';

	//Declare the SesClient and AwsException class
	use Aws\Ses\SesClient;
	use Aws\Exception\AwsException;
	
	$sender_email = "sender@xxx.xxx";
	$recipient_emails = ['recipient@xxx.xxx'];
	$char_set = 'UTF-8';

	$ses_content = "Hi, you have received an email from AWS SES.";

	$params = array(
		'region'    => AWS_SES_REGION,
		'key'        => AWS_ACCESS_KEY,
    	'secret'    => AWS_SECRET_KEY,
		'version'  => 'latest'
	);

	$SesClient = new SesClient($params);

	try {
		$result = $SesClient->sendEmail([
			'Destination' => [
				'ToAddresses' => $recipient_emails,
			],
			'ReplyToAddresses' => [$sender_email],
			'Source' => 'sender@xxx.xxx',
			'Message' => [
			    'Body' => [
			        'Html' => [
				        'Charset' => $char_set,
			    	    'Data' => $semstr,
			        ],
			        'Text' => [
			            'Charset' => $char_set,
			            'Data' => $semstr,
			        ],
			    ],
			    'Subject' => [
			        'Charset' => $char_set,
			        'Data' => $mail_sj,
			    ],
			]
		]);
		$messageId = $result['MessageId'];
		echo("Successfully! Message ID: $messageId"."\n");
	} catch (AwsException $e) {
		echo $e->getMessage();
		echo("Failed. Error message: ".$e->getAwsErrorMessage()."\n");
		echo "\n";
	}

?>