<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';

echo "All OK";

//echo    phpinfo();

$emailAddress = $_POST['emailAddress'];
$emailTitle = $_POST['emailTitle'];
$msg = $_POST['msg']

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  // was 4 for debug
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "mocktlevels@shipley.ac.uk";
$mail->Password   = "ship_Ley862";

$mail->IsHTML(true);
$mail->AddAddress($emailAddress, "");
$mail->SetFrom("mocktlevels@shipley.ac.uk", "Mock T Levels");
// $mail->AddReplyTo("118795@shipley.ac.uk", "");
// $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = $emailTitle;
$content = $msg;

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}

echo "All done";
header ('Location: register.html');

?>

<h1>ok</h1>
