<?php
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	require 'config.php';
    
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $emailtoSend = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(); 
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "mail.lazarnarcis.ro";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->Username = "$email";
    $mail->Password = "$password";
    $mail->SetFrom("$emailtoSend", "$firstname $lastname");
    $mail->Subject = "$subject || From: $firstname $lastname - $emailtoSend";
    $mail->Body = "$message";
    $mail->AddAddress("$email");

    if (isset($message) && isset($subject) && isset($emailtoSend) && isset($lastname) && isset($firstname)) {
        if (!filter_var($emailtoSend, FILTER_VALIDATE_EMAIL)) {
            echo "Please enter a valid email!";
        } else if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo . $firstname;
        } else {
            $sql = "INSERT INTO emails (email, subject, message, name) VALUES ('$emailtoSend', '$subject', '$message', '$firstname $lastname')";
            mysqli_query($link, $sql);
            echo "The email has been sent! Thank you :) You will receive an answer as soon as possible!";
        }
    }
    mysqli_close($link);
?>