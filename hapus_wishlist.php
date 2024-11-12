<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user_id = 1; // Ganti dengan user ID yang sesuai
    $product_id = $_GET['id'];
    $category = $_GET['category'];

    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ? AND category = ?");
    $stmt->bind_param("iis", $user_id, $product_id, $category);

    if ($stmt->execute()) {
        echo "Produk berhasil dihapus dari wishlist.";
    } else {
        echo "Gagal menghapus produk dari wishlist.";
    }
    $stmt->close();
    header("Location: wishlist_page.php");
    exit();
}
?>
