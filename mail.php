<?php
	require_once 'PHPMailerAutoload.php';
	require_once 'db_connection.php';
	require_once 'carsFetch.php';

	$name = $_POST["name"];
	$email = $_POST["email"];
	$car = $_POST["car"];

	$img = preg_replace('/\s+/', '', $car);

	$cars = new CarsFetch();
	$myCars = $cars->get($car);
	$content = '
	<table style="border-collapse:collapse;">
		<tr>
			<th style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;">Auto</th>
			<th style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;">Precio</th>
			<th style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;">Disponibles</th>
		<tr>
		<tr>
	';
		$content .= '
		<tr style="background:">
			<td style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;">'. $myCars['Name'] . '</td>
			<td style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;"> $'. $myCars['Price'] . '</td>
			<td style="text-align:left;width:200px;padding:0.5rem 1rem;border-width:1px; border-style:solid;border-collapse:collapse;">'. $myCars['Cuantity'] .'</td>
		</tr>';	


	$content .= '</table>';

	$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
						<html>
						<head>
						  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
						  <title>Cotizacion de automoviles</title>
						</head>
						<body>
						<div>
						  <div align="center">
						  	<h1>Esta es la cotizacion de automoviles pedida por ' . $name .'</h1>
						    '. $content .'
						  </div>
						</div>
						</body>
						</html>';
	

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'info.fotografiaarte@gmail.com';                 // SMTP username
	$mail->Password = 'fotografiarte';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to

	$mail->setFrom('info.fotografiaarte@gmail.com', 'no-reply');
	$mail->addAddress($email, $name);     // Add a recipient
	$mail->addReplyTo('no-reply@example.com', 'Information');
	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');

	$mail->isHTML(true);                                  // Set email format to HTML

	//Set the subject line
	$mail->Subject = $name.' Comfirmation email';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	
	$mail->msgHTML($body);
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a test for '. $name;
	//Attach an image file
	$mail->addAttachment('img/'.$img.'.jpg');

	//send the message, check for errors
	if (!$mail->send()) {
	    echo 'Sorry <strong>'.$name. '</strong> the message wasnt sent due to an error: '. $mail->ErrorInfo;
	} else {
	    echo 'Thanks <strong>'.$name. '</strong> a message was sent to <strong>' .$email.'</strong>';
	}

?>