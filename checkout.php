<?php
session_start();
include 'config.php';

$product = null;
$columns = null;

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $category = mysqli_real_escape_string($conn, $_GET['category']);

    // Define the table and columns based on category
    switch ($category) {
        case 'Clothes Coquette':
        case 'Type Of Skirt':
        case 'Chic Collection':
        case 'Elegant Blue Styles':
        case 'Stylish Statements':
        case 'trend':
            $table = 'productstrend';
            $columns = [
                'name' => 'name',
                'price' => 'price',
                'image' => 'image',
                'description' => 'description'
            ];
            break;
        case 'accessories':
            $table = 'productsaksesoris';
            $columns = [
                'name' => 'name',
                'price' => 'price',
                'image' => 'image',
                'description' => 'description'
            ];
            break;
        case 'classic-clothing':
            $table = 'products';
            $columns = [
                'name' => 'name',
                'price' => 'price',
                'image' => 'image',
                'description' => 'description'
            ];
            break;
        case 'productssepatuklasik':
            $table = 'productssepatuklasik';
            $columns = [
                'name' => 'name',
                'price' => 'price',
                'image' => 'image',
                'description' => 'description'
            ];
            break;
        case 'productsgrafik':
            $table = 'productsgrafik';
            $columns = [
                'name' => 'name',
                'price' => 'price',
                'image' => 'image',
                'description' => 'description'
            ];
            break;
        default:
            echo "Kategori tidak valid.";
            exit;
    }

    // Query to fetch product details
    $sql = "SELECT * FROM $table WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk atau kategori tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?php echo htmlspecialchars($product[$columns['name']]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkout-container {
            max-width: 900px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
        }
        .checkout-header {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
        }
        .product-info, .payment-form {
            flex: 1;
            padding: 20px;
        }
        .product-info {
            border-right: 1px solid #ddd;
        }
        .product-info img {
            width: 100px;
            margin-right: 20px;
        }
        .product-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #ffb6c1;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff69b4;
        }
        .btn-back {
            background-color: #6c757d;
            color: #fff;
            margin-bottom: 20px;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-back:hover {
            background-color: #5a6268;
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
    </style>
</head>
<body>

<div class="checkout-container">
    <div class="product-info">
        <a href="javascript:history.back()" class="btn-back">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="checkout-header">
            <h1>Checkout</h1>
            <p><?php echo htmlspecialchars($product[$columns['name']]); ?> - Harga: Rp <?php echo number_format($product[$columns['price']], 2, ',', '.'); ?></p>
        </div>
        <div class="product-details">
            <img src="images/<?php echo htmlspecialchars($product[$columns['image']]); ?>" alt="<?php echo htmlspecialchars($product[$columns['name']]); ?>">
            <div>
                <h3><?php echo htmlspecialchars($product[$columns['name']]); ?></h3>
                <p>Harga: Rp <?php echo number_format($product[$columns['price']], 2, ',', '.'); ?></p>
            </div>
        </div>
        <div class="total-price">
            Total: Rp <?php echo number_format($product[$columns['price']], 2, ',', '.'); ?>
        </div>
    </div>
    <div class="payment-form">
        <form action="proses_checkout.php" method="post">
            <input type="hidden" id="product_id" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>" readonly class="form-control">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Alamat:</label>
                <input type="text" id="address" name="address" required class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Telepon:</label>
                <input type="text" id="phone" name="phone" required class="form-control">
            </div>
            <div class="form-group">
                <label for="quantity">Jumlah:</label>
                <input type="number" id="quantity" name="quantity" value="1" required class="form-control">
            </div>
            <div class="form-group">
                <label for="total_price">Total Price:</label>
                <input type="text" id="total_price" name="total_price" value="<?php echo htmlspecialchars($product[$columns['price']]); ?>" readonly class="form-control">
            </div>
            <div class="form-group">
                <label for="payment_method_id">Metode Pembayaran:</label>
                <select id="payment_method_id" name="payment_method_id" required class="form-select">
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    <option value="2">Q-RIS</option>
                    <option value="3">E-wallet</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
