<?php
    $whitelist = array(
        '127.0.0.1',
        '::1'
    );
    
    if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
        $username_db = getenv("username_db");
        $password_db = getenv("password_db");
        $host_db = getenv("host_db");
        $database_db = getenv("database_db");
    } else {
        $username_db = "root";
        $password_db = "";
        $database_db = "portfolio";
        $host_db = "localhost";
    }

    $link = mysqli_connect($host_db, $username_db, $password_db, $database_db);
    if (!$link) {
        echo "Problems with sql database.";
    }
?>