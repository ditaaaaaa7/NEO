<?php
$servername = "localhost"; // Nama Server
$username = "root"; // Username XAMPP
$password = ""; // Password XAMPP
$db_name = "neo"; // Nama DB

//Membuat koneksi
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $db_name
);

//Cek kondisi
if ($conn->connect_error) {
    die("Connection Failed" .
        $conn->connect_error);
} else {
    echo "";
}
?>