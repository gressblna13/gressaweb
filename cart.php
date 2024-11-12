<?php
session_start();
include 'config.php';

// Ganti dengan user ID Anda
$user_id = 5;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['product_id']) && !empty($_POST['quantity']) && !empty($_POST['total_price']) && !empty($_POST['image'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        $query = "INSERT INTO cart (product_id, user_id, quantity, total_price, image) VALUES ('$product_id', '$user_id', '$quantity', '$total_price', '$image')";
        if (mysqli_query($conn, $query)) {
            header("Location: cart.php"); // Pengalihan setelah sukses
            exit();
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Harap isi semua data yang diperlukan.";
    }
}

// Menampilkan data keranjang
$query = "SELECT cart.*, latest.name, latest.price, latest.image FROM cart INNER JOIN latest ON cart.product_id = latest.id WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .cart-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            padding: 10px;
            text-align: left;
        }
        .cart-table th {
            background-color: #f2f2f2;
        }
        .cart-total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
        }
        footer {
            background-color: #ffb6c1;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        .social-media a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.5em;
        }
        header {
            background: #fff;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header .logo img {
            margin-left: 10px;
            width: 100px;
            height: auto;
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding-left: 0;
        }
        nav ul li {
            margin: 0 10px;
            position: relative;
        }
        nav ul li a {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #c9ad93;
        }
        .user-actions {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }
        .user-actions .icon {
            text-decoration: none;
            color: #8B4513;
            font-size: 20px;
            margin-left: 20px;
            transition: color 0.3s;
        }
        .user-actions .icon:hover {
            color: #c9ad93;
        }
        .user-actions .icon-cart {
            color: #8B4513;
        }
        .user-actions .sign-in {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            margin-left: 20px;
            transition: color 0.3s;
        }
        .user-actions .sign-in:hover {
            color: #c9ad93;
        }
        .user-actions .cart-count {
            background: #ffd1dc;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 14px;
            vertical-align: top;
            margin-left: 5px;
        }
        .navbar-brand img {
            width: 100px;
            height: auto;
        }
        @media (max-width: 768px) {
            .user-actions {
                display: none;
            }
        }
    </style>
</head>
<body>
<header class="bg-white shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="logo">
                <a href="uas_manies.php">
                    <img src="images/logo.png" alt="MyBrand Logo" width="100">
                </a>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="LATEST.PHP">LATEST</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="trend.php">TRENDY</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="timeless.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    TIMELESS
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="pakaianklasik.php">Classic clothes</a></li>
                                    <li><a class="dropdown-item" href="timeless/classic-footwear.html">Classic shoes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="aksesoris.php">ACCESSORIES</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="grafik.php">GRAPHICS</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="user-actions d-flex align-items-center">
                <a href="#" class="icon search me-3" onclick="toggleSearchForm()"><i class="bi bi-search"></i></a>
                <div id="searchForm" class="search-form" style="display: none;">
                    <form id="searchForm" onsubmit="search(event)">
                        <input type="text" name="query" id="searchInput" placeholder="Search...">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                <a href="wishlist.php" class="icon me-3"><i class="bi bi-heart"></i></a>
                <a href="USERS.PHP" class="icon me-3"><i class="bi bi-person"></i></a>
                <a href="#" class="icon icon-cart"><i class="bi bi-cart"></i></a>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <h1>Keranjang Belanja</h1>
    <table class="table table-bordered cart-table">
        <thead class="thead-light">
            <tr>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $item_total = $row['price'] * $row['quantity'];
                $total += $item_total;
                echo "<tr>
                        <td><img src='images/{$row['image']}' alt='{$row['name']}' style='width: 50px; height: auto;'></td>
                        <td>{$row['name']}</td>
                        <td>Rp " . number_format($row['price'], 2, ',', '.') . "</td>
                        <td>{$row['quantity']}</td>
                        <td>Rp " . number_format($item_total, 2, ',', '.') . "</td>
                        <td><a href='remove_from_cart.php?id={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a></td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="cart-total">
        Total: Rp <?php echo number_format($total, 2, ',', '.'); ?>
    </div>
    <a href="checkout.php" class="btn btn-primary">Checkout</a>
</div>

<footer class="mt-4">
    <div class="social-media">
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #3b5998"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #55acee"><i class="fab fa-twitter"></i></a>
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39"><i class="fab fa-google"></i></a>
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac"><i class="fab fa-instagram"></i></a>
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #0082ca"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="btn btn-primary btn-floating m-1" style="background-color: #333333"><i class="fab fa-github"></i></a>
    </div>
    <p>&copy; 2024 Neocult. Semua hak cipta dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    function toggleSearchForm() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
        } else {
            searchForm.style.display = 'none';
        }
    }
</script>
</body>
</html>
