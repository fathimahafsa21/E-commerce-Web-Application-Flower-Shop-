<?php

$db_name = 'mysql:host=localhost;dbname=flowershop_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

if (!$conn) {
    echo " not connected to database";
}

function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLength = strLen($chars);
    $randomString = '';

    for ($i=0; $i < 20; $i++) {
    $randomString.=$chars[mt_rand(0, $charsLength - 1)];
}
    return $randomString;
}

?>