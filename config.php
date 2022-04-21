<?php
    $whitelist = array(
        '127.0.0.1',
        '::1'
    );
    
    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $username_db = "root";
        $password_db = "";
        $database_db = "portfolio";
        $host_db = "localhost";
    } else {
        $username_db = "root";
        $password_db = "";
        $database_db = "portfolio";
        $host_db = "localhost";
    }

    $email = "email";
	$password = "email_password";

    $link = mysqli_connect($host_db, $username_db, $password_db, $database_db);
    if (!$link) {
        echo "Problems with sql database.";
    }
?>