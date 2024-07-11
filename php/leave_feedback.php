<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';
    require '../config.php'; 

    $message = htmlspecialchars($_POST['feedback']);
    $emailtoSend = htmlspecialchars($_POST['email']);
    $subject = "Portfolio Feedback";

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = false;  
        $mail->Host = $mail_host;  
        $mail->Port = $mail_port; 
        $mail->Username = $email; 
        $mail->Password = $password; 
        
        $mail->setFrom($email, "Feedback - $emailtoSend");
        $mail->addAddress($mail_to);

        $mail->isHTML(true); 
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $sql = "INSERT INTO emails (email, subject, message, name) VALUES ('$emailtoSend', '$subject', '$message', 'BOT')";
            mysqli_query($link, $sql);
            echo "Your feedback has been sent! Thank you!";
        } else {
            throw new Exception("Error feedback send: " . $mail->ErrorInfo);
        }
    } catch (Exception $e) {
        echo "Error mail send: {$mail->ErrorInfo}";
    }
?>
