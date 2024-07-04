<?php

$user_ip = $_SERVER['REMOTE_ADDR'];
$sql = "select * from user_activity where user_ip = '$user_ip'";
$user_activity = mysqli_query($link, $sql);
$user_activity = mysqli_fetch_assoc($user_activity);

if ($user_activity) {
    $sql = "update user_activity set joins=joins+1 where user_ip='$user_ip'";
    mysqli_query($link, $sql);
} else {
    $sql = "insert into user_activity (user_ip, joins) values ('$user_ip', 1)";
    mysqli_query($link, $sql);
}
