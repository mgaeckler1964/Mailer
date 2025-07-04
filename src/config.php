<?php

	use PHPMailer\PHPMailer\PHPMailer;

	$mail->isSMTP();
	$mail->SMTPAuth = true;
	// Persönliche Angaben

	$mail->Host = "XXXX";
	$mail->Port = 666;
	$mail->Username = "XXXX";
	$mail->Password = "XXXX";

	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

	$serverName = $_SERVER["SERVER_NAME"];

	$config = "config." . $serverName . ".php";
	if( is_file( $config ) )
		include_once( $config );

?>
