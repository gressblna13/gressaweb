<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uas_manis";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hapus atau komentari baris ini
// echo "Connected successfully";

?>
