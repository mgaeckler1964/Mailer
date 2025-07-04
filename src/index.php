<?php
	// http://mailer.gaeckler.at/?file=mail.txt&nextUrl=https://vote.gaeckler.at/
	require_once( "phpMailer/Exception.php");
	require_once( "phpMailer/PHPMailer.php");
	require_once( "phpMailer/SMTP.php");
	
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if( array_key_exists("file", $_GET ) )
	{
		$file = $_GET["file"];
	}
	else
	{
		$file = "";
	}
	if( array_key_exists("nextUrl", $_GET ) )
	{
		$nextUrl = $_GET["nextUrl"];
	}
	else
	{
		$nextUrl = "";
	}

	if( $file == "" )
	{
		echo("file does not exist");
		exit();
	}

	if( !is_file($file)	 )
	{
		echo($file . " does not exist");
		exit();
	}

	if( $nextUrl == "" )
	{
		echo("nextUrl does not exist");
		exit();
	}
	
	$handle = fopen ( $file, "r");
	$from = trim(fgets($handle));
	$to = trim(fgets($handle));
	$subject = trim(fgets($handle));
	$body = "";
	
	while (!feof($handle))
	{
		$line = fgets($handle);
		$body = $body . $line;
	}
	fclose ($handle);

/*	
	echo($from);
	echo($to);
	echo($subject);
	echo($body);
*/
	unlink($file);

	try {

    	// Versuch, eine neue Instanz der Klasse PHPMailer zu erstellen, wobei Ausnahmen aktiviert sind
		global $mail;
	    $mail = new PHPMailer (true);

		require_once( "config.php");

		$mail->setFrom($from, 'Mailer');
		// Empfänger, optional kann der Name mit angegeben werden
		$mail->addAddress($to, 'Receiver');
		
		$mail->Subject = $subject;
		$mail->Body = $body;

		$mail->send();

		header( "Location: " . $nextUrl );
		echo "<html>";
        echo "<head><title>Mailer OK</title></head>";
        echo "<body>";
        echo "<h1>Mailer OK</h1>";
        echo "<pre>";
        echo "|" . $from . "|";
        echo "|" . $subject . "|";
        echo "|" . $to . "|";
        echo "</pre>";
        echo "<p><a href='". $nextUrl ."'>weiter</a></p>";
        echo "</body>";
		echo "</html>";
	} catch (Exception $e) {
        echo "Mailer Error: ".$e->getMessage();
	}
	
?>



