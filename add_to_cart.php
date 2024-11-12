<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    
    // Periksa apakah session cart sudah ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Periksa apakah item sudah ada di cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
        echo "Item berhasil ditambahkan ke keranjang!";
    } else {
        echo "Item sudah ada di keranjang Anda.";
    }
    exit;
}
?>
