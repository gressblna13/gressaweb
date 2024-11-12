<?php
session_start();
include 'config.php';

$user_id = 1; // Sesuaikan dengan user ID Anda

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (!empty($_POST['product_id']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_image']) && !empty($_POST['quantity'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
        $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $total_price = $product_price * $quantity;

        $query = "INSERT INTO cart (product_id, user_id, quantity, total_price, image) VALUES ('$product_id', '$user_id', '$quantity', '$total_price', '$product_image')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Item added to cart successfully!');</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Harap isi semua data yang diperlukan.";
    }
}

function displayProducts($category) {
    global $conn;
    $query = "SELECT * FROM latest WHERE category='$category'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="product-grid">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<div class="wishlist-icon">';
                echo '<a href="wishlist.php?add=' . $row['id'] . '"><i class="bi bi-heart"></i></a>';
                echo '</div>';
                echo '<a href="beli.php?id=' . $row['id'] . '&category=' . $category . '">';
                echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>Rp ' . number_format($row['price'], 2, ',', '.') . '</p>';
                echo '<p>' . $row['description'] . '</p>';
                echo '</a>';
                echo '<p class="coming-soon">Coming Soon</p>'; // Ganti dengan teks Coming Soon
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo 'No products found.';
        }
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest - Neocult Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
     body {
            font-family: Arial, sans-serif;
            color: #333;
        }

    /* Wrapper untuk memberikan jarak di kanan dan kiri */
    .container-wrapper {
        max-width: calc(100% - 20px); /* Menyisakan 10px di kanan dan kiri */
        margin: 0 auto;
        padding-left: 10px;
        padding-right: 10px;
        box-sizing: border-box;
    }

    .navbar-brand img {
        max-height: 80px;
    }

    .nav-link {
        color: #555;
        font-weight: bold;
    }

    .nav-link:hover {
        color: #000;
    }

    header .navbar-brand img {
    width: 80px;
    height: auto;
}

@media (max-width: 768px) {
    .user-actions .icon {
        font-size: 18px;
    }

    header .navbar-nav .nav-link {
        font-size: 14px;
        margin: 5px 0;
    }
}


    nav {
        background: #fff;
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

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #ffd1dc;
        color: #a2c4c9;
        border-radius: 4px;
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
        background: #c9ad93;
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

    /* Responsiveness */
    @media (max-width: 992px) {
        .user-actions {
            margin: 10px 0;
            justify-content: center;
        }

        .navbar-nav {
            flex-direction: column;
            text-align: center;
        }
    }

    @media (max-width: 768px) {
        nav ul {
            display: block;
            text-align: center;
        }

        .user-actions .icon,
        .user-actions .sign-in {
            font-size: 18px;
        }

        .navbar-brand img {
            width: 80px;
        }
    }

    .hero {
        position: relative;
        height: 50vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        background: url('images/bg.jpg') no-repeat center center/cover;
        animation: fadeIn 2s ease-in-out;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .hero-text {
        position: relative;
        z-index: 2;
        color: #fff;
        max-width: 80%;
        text-align: center;
    }

    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    .shop-now {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        color: #fff;
        background-color: #333;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .shop-now:hover {
        background: #b08d79;
    }

    .products {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .section-title {
        font-size: 2rem;
        color: #333;
        margin-bottom: 0;
        text-align: center;
        position: relative;
    }

    .section-paragraph {
        font-size: 1.5rem;
        color: #333;
        text-align: center;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .section-title::after {
        content: '';
        width: 60px;
        height: 4px;
        background: #333;
        display: block;
        margin: 10px auto;
        border-radius: 2px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        width: 100%;
        max-width: 1200px;
    }

    /* Styling untuk Card */
.product {
    position: relative;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

/* Efek hover pada gambar */
.product img {
    max-width: 100%;
    border-bottom: 2px solid #eee;
    border-radius: 10px;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.product:hover img {
    transform: scale(1.1);
}

/* Styling untuk judul produk */
.product h2 {
    font-size: 1.4rem;
    color: #333;
    font-weight: bold;
    margin: 10px 0;
    transition: color 0.3s ease;
    font-family: 'Roboto', sans-serif; /* Gaya font yang lebih modern */
}

.product:hover h2 {
    color: #8B4513;
}

/* Styling untuk harga */
.product p {
    color: #777;
    font-size: 1rem;
    margin: 5px 0;
    transition: color 0.3s ease;
    font-family: 'Roboto', sans-serif;
}

.product:hover p {
    color: #555;
}

/* Styling untuk deskripsi */
.product p.description {
    color: #555;
    font-size: 0.9rem;
    font-style: italic;
    margin-bottom: 15px;
}

/* Styling untuk teks Coming Soon */
.coming-soon-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    border-radius: 15px;
    font-family: 'Roboto', sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

/* Efek hover untuk menampilkan Coming Soon */
.product:hover .coming-soon-overlay {
    display: flex;
    opacity: 1;
}

/* Animasi tambahan */
.product h2, .product p {
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.product:hover h2, .product:hover p {
    opacity: 1;
    transform: translateY(0);
}


    .wishlist-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #8B4513;
    }

    .wishlist-icon a {
        text-decoration: none;
        color: inherit;
    }

    .wishlist-icon a:hover {
        color: #c9ad93;
    }

    .coming-soon {
        color: #d3d3d3;
        margin-top: 10px;
    }

    .dropdown-menu {
        background-color: #fff;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 4px;
        padding: 10px;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: #ffd1dc;
        color: #a2c4c9;
        border-radius: 4px;
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

    footer {
        background-color: #ffd1dc;
        color: #fff;
        text-align: center;
        padding: 50px 0;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    .footer-waves {
        position: absolute;
        top: 0;
        width: 100%;
        height: 50px;
        background: url('path/to/waves.png') repeat-x;
        background-size: cover;
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        flex: 1 1 200px;
        margin: 20px;
    }

    .footer-section h3 {
        margin-bottom: 20px;
        font-size: 20px;
        color: #8B4513;
    }

    .footer-section p,
    .footer-section a {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
    }

    .footer-section a:hover {
        color: #8B4513;
        text-decoration: none;
    }

    .newsletter-form input[type="email"] {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: calc(100% - 100px);
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .newsletter-form input[type="submit"] {
        padding: 10px 20px;
        border: none;
        background-color: #8B4513;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .newsletter-form input[type="submit"]:hover {
        background-color: #c9ad93;
    }
    .wishlist-icon {
    display: none;
    }

</style>

</head>
<body>

<div class="container-wrapper">
        <!-- Header Section -->
        <div class="container-wrapper">
    <!-- Header Section -->
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="UAS_MANIES.PHP">
                <img src="images/svt.png" alt="Brand Logo" width="80" height="auto">
            </a>
            
            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="LATEST.PHP">LATEST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trend.php">TRENDY</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TIMELESS
                        </a>
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

                <!-- User Actions: Search and Account -->
                <div class="d-flex align-items-center">
                    <a href="#" class="icon mx-2"><i class="fas fa-search"></i></a>
                    <a href="#" class="icon mx-2"><i class="fas fa-user"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>

</div>



<section class="products">
    <h1 class="section-title">Clothes Coquette</h1>
    <?php displayProducts('Clothes Coquette'); ?>
</section>

<section class="products">
    <h1 class="section-title">Type Of Skirt</h1>
    <?php displayProducts('Type Of Skirt'); ?>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Chic Collection</h1>
    <?php displayProducts('Chic Collection'); ?>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Elegant Blue Styles</h1>
    <?php displayProducts('Elegant Blue Styles'); ?>
</section>

<section class="products">
    <h1 class="section-title">Stylish Statements</h1>
    <?php displayProducts('Stylish Statements'); ?>
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
