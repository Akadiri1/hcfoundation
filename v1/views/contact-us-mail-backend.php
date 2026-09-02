<?php

$request_headers = getallheaders();
if($_SERVER['REQUEST_METHOD'] !=="POST"){
   http_response_code(502);
   die;
}

if( !in_array($request_headers['Host'], $allowedHeaders) ){
  http_response_code(502);
  die;
}


$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json,true);
// die(var_dump($data));

$result = [];

// print_r($data);
// die;

extract($data);

if (!isset($data['g_recaptcha_token'])) {
  $result['failed'] = "Please complete the reCAPTCHA";
  $result = json_encode($result);
  echo $result;
  die;
}


$GoogleRecaptcha = new GoogleRecaptcha();

$verify_captcha = $GoogleRecaptcha->verify($data['g_recaptcha_token'], "CONTACT_FORM");

if (!$verify_captcha) {
  $result['failed'] = "Please complete the reCAPTCHA";
  $result = json_encode($result);
  echo $result;
  die;
}

$site_email_smtp_secure_type = $mailSmtpSecureType;
$site_email_smtp_host = $mailSmtpHost;
$site_email_smtp_port = $mailSmtpPort;


$subject = "Contact - ".$site_name;
$to = $site_email;

$userMessage = "Dear $name, We are glad to receive your message, we'll get in touch with you soonest.";




try {

require APP_PATH.'/phpm/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP(); // Set mailer to use SMTP
// $mail->SMTPDebug = 2; // Enable verbose debug output
$mail->Host = $site_email_smtp_host; // Specify main and backup SMTP servers
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->Username = $mailUsername; // SMTP username
$mail->Password = $mailPassword; // SMTP password
$mail->SMTPSecure = $site_email_smtp_secure_type;; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
$mail->Port = $site_email_smtp_port;
$mail->setFrom($site_email, $site_name);
// $mail->addAddress($email, $name); // Add a recipient
$mail->addAddress($email); // Name is optional
$mail->addReplyTo($site_email, $site_name);
$mail->isHTML(true); // Set email format to HTML
$mail->Subject = $subject;
$mail->Body = $userMessage;
$mail->AltBody = "Do not send a reply to this mail";


$mail2admin = new PHPMailer;
$mail2admin->isSMTP(); // Set mailer to use SMTP
// $mail2admin->SMTPDebug = 2; // Enable verbose debug output
$mail2admin->Host = $site_email_smtp_host; // Specify main and backup SMTP servers
$mail2admin->SMTPAuth = true; // Enable SMTP authentication
$mail2admin->Username = $mailUsername; // SMTP username
$mail2admin->Password = $mailPassword; // SMTP password
$mail2admin->SMTPSecure = $site_email_smtp_secure_type;; // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
$mail2admin->Port = $site_email_smtp_port;
$mail2admin->setFrom($mailSender, $site_name);
// $mail->addAddress($email, $name); // Add a recipient
$mail2admin->addAddress($site_email); // Name is optional
$mail2admin->addReplyTo($site_email, $site_name);
$mail2admin->isHTML(true); // Set email format to HTML
$mail2admin->Subject = $subject;
$mail2admin->Body = "<h3>Dear Admin You have a </h3><p>Message from $site_name </p>";

$mail2admin->AltBody = "Do not send a reply to this mail";

if (isset($name) && !empty($name)) {
    $mail2admin->Body.="<p>Name: ".$name."</p>";
}
if (isset($email) && !empty($email)) {
    $mail2admin->Body.="<p>Email: ".$email."</p>";
}

if (isset($email) && !empty($email)) {
    $mail2admin->Body.="<p>Phone: ".$phone."</p>";
}

if (isset($email) && !empty($email)) {
    $mail2admin->Body.="<p>Subject: ".$subject."</p>";
}
if (isset($message) && !empty($message)) {
    $mail2admin->Body.="<p>Message: ".$message."</p>";
}



if($mail->send() && $mail2admin->send()) {
  $result['success'] = "Message Sent Successfully, we'll get in touch with you soonest.";
}else{
  $result['failed'] = "Sorry, an error occured, please try again.";
}
$result['sent']="here is the main thing";

} catch (\Exception $e) {
  // echo $e->getMessage();
  $result['failed'] = "Sorry, an error occured, please try again.";

}


$result = json_encode($result);
echo $result;

 ?>
