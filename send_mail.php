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

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
        $mail->Host = $mail_host;  
        $mail->Port = $mail_port; 
        $mail->Username = $email; 
        $mail->Password = $password; 
        
        $mail->setFrom($email, "$emailtoSend - $firstname $lastname");
        $mail->addAddress($mail_to);

        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $sql = "INSERT INTO emails (email, subject, message, name) VALUES ('$emailtoSend', '$subject', '$message', '$firstname $lastname')";
            mysqli_query($link, $sql);
            echo "The email has been sent! Thank you :) You will receive an answer as soon as possible!";
        } else {
            throw new Exception("Error mail send: " . $mail->ErrorInfo);
        }
    } catch (Exception $e) {
        echo "Error mail send: {$mail->ErrorInfo}";
    }
?>
