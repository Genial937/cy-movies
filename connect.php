<?php
$host = '127.0.0.1';
$db = "movies";
$user = "root";
$pass = "";
try {
    $con = mysqli_connect($host, $user, $pass, $db) or die();
} catch (\Throwable $th) {
    return $th;
}


?>