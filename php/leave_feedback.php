<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../config.php';

$message = htmlspecialchars($_POST['message']);
$emailtoSend = htmlspecialchars($_POST['email']);
$subject = "Portfolio Feedback";

$name = $_POST['name'];
$temail = $_POST['email'];
$profile_picture = $_POST['profile_picture'];
$project_name = $_POST['project_name'];
$project = $_POST['project'];
$stars = $_POST['stars'];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Host = $mail_host;  
    $mail->Port = $mail_port; 
    $mail->Username = $email; 
    $mail->Password = $password; 
    
    $mail->setFrom($email, "Feedback - $emailtoSend");
    $mail->addAddress($mail_to);

    $mail->isHTML(true); 
    $mail->Subject = $subject;
    $mail->Body    = $message;

    $saveFolder = dirname(__DIR__) . "/clients-photo/";
    if (!file_exists($saveFolder)) {
        mkdir($saveFolder, 0777, true);
    }

    $headers = @get_headers($profile_picture, 1);
    if (!$headers || !isset($headers['Content-Type']) || !preg_match('/^image\/(jpeg|png|gif|bmp|webp)$/i', $headers['Content-Type'])) {
        echo json_encode(['type' => "error", "message" => "Eroare: Fișierul furnizat nu este o imagine validă."]);
        exit;
    }

    $fileExtension = pathinfo($profile_picture, PATHINFO_EXTENSION);
    $image = null;

    if ($fileExtension == 'jpg' || $fileExtension == 'jpeg') {
        $image = imagecreatefromjpeg($profile_picture);
    } elseif ($fileExtension == 'png') {
        $image = imagecreatefrompng($profile_picture);
    } elseif ($fileExtension == 'gif') {
        $image = imagecreatefromgif($profile_picture);
    } elseif ($fileExtension == 'bmp') {
        $image = imagecreatefrombmp($profile_picture);
    } elseif ($fileExtension == 'webp') {
        $image = imagecreatefromwebp($profile_picture);
    }

    if ($image) {
        $newImage = imagecreatetruecolor(100, 100);
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, 100, 100, imagesx($image), imagesy($image));
        $uniqueId = uniqid('profile_', true);
        $fileName = $uniqueId . "." . $fileExtension;
        $fullPath = $saveFolder . $fileName;

        if ($fileExtension == 'jpg' || $fileExtension == 'jpeg') {
            imagejpeg($newImage, $fullPath);
        } elseif ($fileExtension == 'png') {
            imagepng($newImage, $fullPath);
        } elseif ($fileExtension == 'gif') {
            imagegif($newImage, $fullPath);
        } elseif ($fileExtension == 'bmp') {
            imagebmp($newImage, $fullPath);
        } elseif ($fileExtension == 'webp') {
            imagewebp($newImage, $fullPath);
        }

        imagedestroy($newImage);
        imagedestroy($image);

        $basePath = '/var/www/html/dev-hub.ro';
        $newPath = str_replace($basePath, '', $fullPath);

        if ($mail->send()) {
            $sql = "INSERT INTO emails (email, subject, message, name) VALUES ('$emailtoSend', '$subject', '$message', 'BOT')";
            mysqli_query($link, $sql);
            $sql = "INSERT INTO feedbacks (name, email, message, profile_picture, project_name, project_id, stars) VALUES ('$name','$temail', '$message','$newPath','$project_name','$project','$stars')";
            mysqli_query($link, $sql);
            echo json_encode(['type' => "success", "message" => "Your feedback has been sent! Thank you! <b>Wait administrator to verify...</b>"]);
        } else {
            throw new Exception("Error feedback send: " . $mail->ErrorInfo);
        }
    } else {
        echo json_encode(['type' => "error", "message" => "Eroare: Nu s-a putut încărca imaginea."]);
    }
} catch (Exception $e) {
    echo (['type' => "error", "message" => "Error mail send: {$mail->ErrorInfo}"]);
}
?>
