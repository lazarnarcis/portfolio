<?php
  use PHPMailer\PHPMailer;
  use PHPMailer\Exception;
  use PHPMailer\SMTP;
  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  $mail->Username   = "narcislazar2003@gmail.com";
  $mail->Password   = "";

  $mail->IsHTML(true);
  $mail->AddAddress("lazarnarcis203@gmail.com", "recipient-name");
  $mail->SetFrom("narcislazar2003@gmail.com", "set-from-name");
  $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
  $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
  } else {
    echo "Email sent successfully";
  }
?>