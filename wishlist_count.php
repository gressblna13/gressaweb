<?php
session_start();
include 'config.php';

$user_id = 1; // Ganti dengan user ID yang sesuai

$query = "SELECT COUNT(*) AS count FROM wishlist WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
echo $row['count'];

mysqli_close($conn);
?>
