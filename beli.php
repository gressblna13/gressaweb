<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manis");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$product = null;
$columns = null;

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $category = mysqli_real_escape_string($conn, $_GET['category']);

    if ($category == 'Clothes Coquette' || $category == 'Type Of Skirt' || $category == 'Chic Collection' || $category == 'Elegant Blue Styles' || $category == 'Stylish Statements') {
        $table = 'latest';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } elseif ($category == 'accessories') {
        $table = 'productsaksesoris';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } elseif ($category == 'classic-clothing') {
        $table = 'products';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } elseif ($category == 'trend') {
        $table = 'productstrend';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } elseif ($category == 'productssepatuklasik') {
        $table = 'productssepatuklasik';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } elseif ($category == 'productsgrafik') {
        $table = 'productsgrafik';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image',
            'description' => 'description'
        ];
    } else {
        echo "Kategori tidak valid.";
        exit;
    }

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
    <title>Beli Sekarang - <?php echo htmlspecialchars($product[$columns['name']]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        header {
            background: #fff;
            padding: 1px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header .logo img {
            margin-left: 10px;
            width: 100px;
            height: auto;
        }
        nav {
            flex-grow: 1;
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
        nav ul li .dropdown-menu {
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px;
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 2000;
        }
        nav ul li:hover .dropdown-menu {
            display: block;
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
        .user-actions .cart-count {
            background: #c9ad93;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 14px;
            vertical-align: top;
            margin-left: 5px;
        }
        .product-details {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
        }
        .product-details .product-image {
            flex: 1;
            max-width: 400px;
            margin-right: 20px;
        }
        .product-details .product-info {
            flex: 2;
        }
        .product-details img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-details h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
        .product-details p {
            font-size: 1.25rem;
            color: #666;
            margin-bottom: 20px;
        }
        .product-details .btn {
            background-color: #c9ad93;
            color: #fff;
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .product-details .btn:hover {
            background-color: #a87c67;
        }
        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .search-form {
            display: none;
            position: absolute;
            top: 90px;
            right: 50px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 4px;
            z-index: 1500;
        }
        .search-form input {
            width: 200px;
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-form button {
            padding: 5px 10px;
            border: none;
            background-color: #8B4513;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-form button:hover {
            background-color: #c9ad93;
        }
    </style>
</head>
<body>

<header>
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="images/svt.png" alt="Brand Logo" width="80" height="auto">
                    </a>
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">TIMELESS</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="pakaianklasik.php">Classic Clothes</a></li>
                                    <li><a class="dropdown-item" href="sepatuklasik.php">Classic Shoes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="grafik.php">GRAPHICS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="aksesoris.php">ACCESSORIES</a>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center">
                            <a href="" class="icon mx-2"><i class="fas fa-search"></i></a>
                            <a href="#" class="icon mx-2"><i class="fas fa-user"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>


<section class="product-details container">
    <div class="product-image">
        <img src="images/<?php echo $product[$columns['image']]; ?>" alt="<?php echo $product[$columns['name']]; ?>">
    </div>
    <div class="product-info">
        <h1><?php echo $product[$columns['name']]; ?></h1>
        <p>Price: Rp <?php echo number_format($product[$columns['price']], 2, ',', '.'); ?></p>
        <p>Description: <?php echo $product[$columns['description']]; ?></p>
        <a href="checkout.php?id=<?php echo $product['id']; ?>&category=<?php echo $category; ?>" class="btn">Proceed to Checkout</a>
    </div>
</section>

<!-- Footer -->
<footer class="text-center mt-5" style="background-color:#b6dcec;">
    <div class="container p-4">
        <section class="mb-4">
            <!-- Social Media Links -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
        </section>

        <!-- Newsletter Signup -->
        <section class="mb-4">
            <form action="">
                <div class="row d-flex justify-content-center">
                    <div class="col-auto">
                        <p class="pt-2"><strong>Sign up for our newsletter</strong></p>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="form-outline mb-4">
                            <input type="email" id="form5Example2" class="form-control" />
                            <label class="form-label" for="form5Example2">Email address</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Image Gallery -->
        <section class="mb-4">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu6.jpg" class="img-fluid rounded" alt="Gallery Image 1" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu1.jpg" class="img-fluid rounded" alt="Gallery Image 2" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu5.jpg" class="img-fluid rounded" alt="Gallery Image 3" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu3.jpg" class="img-fluid rounded" alt="Gallery Image 4" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu4.jpg" class="img-fluid rounded" alt="Gallery Image 5" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu2.jpg" class="img-fluid rounded" alt="Gallery Image 6" />
                </div>
            </div>
        </section>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: <a class="text-dark" href="UAS_MANIES.PHP">CARAT.com</a>
    </div>
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
