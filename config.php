<?php
    require_once __DIR__ . '/vendor/autoload.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $whitelist = array(
        '127.0.0.1',
        '::1'
    );
    
    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $username_db = $_ENV['username_db'];
        $password_db = $_ENV['password_db'];
        $database_db = $_ENV['database_db'];
        $host_db = $_ENV['host_db'];
        $port_db = $_ENV['port_db'];

        $mail_smtp = $_ENV['MAIL_SMTP'];
        $mail_host = $_ENV['MAIL_HOST'];
        $mail_port = $_ENV['MAIL_PORT'];
        $email = $_ENV['GMAIL_EMAIL'];
        $password = $_ENV['GMAIL_PASSWORD'];

        $mail_to = $_ENV['SEND_MAILS_TO'];
    } else {
        $username_db = "root";
        $password_db = "";
        $database_db = "portfolio";
        $host_db = "localhost";
        $port_db = 3306;

        $mail_smtp = "tls";
        $mail_host = "example.host.com";
        $mail_port = "597";
        $email = "example@contact.com";
        $password = "myPassword123";

        $mail_to = "";
    }

    $link = mysqli_connect($host_db, $username_db, $password_db, $database_db, $port_db);
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
