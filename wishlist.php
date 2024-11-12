<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $category = $_POST['category'];

    // Cek apakah produk sudah ada di wishlist
    $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Product is already in your wishlist!";
    } else {
        $query = "INSERT INTO wishlist (user_id, product_id, category) VALUES ('$user_id', '$product_id', '$category')";
        if (mysqli_query($conn, $query)) {
            echo "Product added to wishlist!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
