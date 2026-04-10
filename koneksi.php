<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "forop4t";
$port = 3306; 

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Error koneksi: " . mysqli_connect_error());
}
?>
