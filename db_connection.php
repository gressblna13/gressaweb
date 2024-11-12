<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uas_manies";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
