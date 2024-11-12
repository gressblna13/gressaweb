<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "DELETE FROM cart WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
