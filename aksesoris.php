<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uas_manis");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk format Rupiah
function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 2, ',', '.');
}

// Memulai session untuk wishlist
session_start();
$wishlistCount = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;

// Fungsi untuk menampilkan produk
function displayProducts($conn, $category) {
    $sql = "SELECT * FROM productsaksesoris WHERE category='$category' LIMIT 4";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product">';
            echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
            echo '<h2>' . $row["name"] . '</h2>';
            echo '<p>' . formatRupiah($row["price"]) . '</p>';
            echo '<a href="beli.php?id=' . $row["id"] . '&category=accessories" class="btn btn-pink mb-2">Beli Sekarang</a>';
            echo '<a href="tambah_keranjang.php?id=' . $row["id"] . '&category=accessories" class="btn btn-blue"><i class="bi bi-cart"></i></a>';
            echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '"></i>'; // Wishlist icon
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
}

// Mendapatkan parameter pencarian
$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// Mencari produk berdasarkan nama atau deskripsi yang sesuai dengan query pencarian
$sql_search = "SELECT * FROM productsaksesoris WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
$result_search = mysqli_query($conn, $sql_search);

$searchResults = [];
if ($result_search && mysqli_num_rows($result_search) > 0) {
    while ($row = mysqli_fetch_assoc($result_search)) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEOcult.com-Aksesoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
   
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
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
    .hero {
        position: relative;
        height: 50vh;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        background: url('images/oce2.png') no-repeat center center/cover;
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
    .product {
        background: #ffdce0; /* Pink pastel */
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease;
        position: relative;
    }
    .product img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .product:hover {
        transform: scale(1.05);
    }
    .product h2 {
        font-size: 1.25rem;
        color: #333;
        margin: 10px 0;
    }
    .product p {
        color: #777;
        font-size: 1rem;
        margin: 10px 0;
    }
    .product a {
        text-decoration: none;
        color: inherit;
    }
    .product a:hover h2,
    .product a:hover p {
        color: #000;
    }
    .wishlist-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s;
    }
    .wishlist-icon.active {
        color: #b0c4de;
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
        background-color: #f5d9d9;
    }

    /* Styling untuk tombol Beli Sekarang dan ikon keranjang */
    .btn-pink {
        display: inline-block;
        background-color: #ff8fa3; /* Pink pastel lebih gelap */
        color: #fff;
        padding: 8px 15px;
        font-size: 0.9rem;
        border-radius: 5px;
        text-transform: uppercase;
        font-weight: bold;
        transition: background-color 0.3s ease;
        text-decoration: none;
        margin-top: 10px;
        margin-right: 10px;
    }

    .btn-pink:hover {
        background-color: #ff6f8c;
    }

    .btn-blue {
        background-color: #a2d5f2; /* Biru pastel */
        color: #fff;
        padding: 8px 12px;
        font-size: 0.9rem;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-blue:hover {
        background-color: #82c4e1;
    }

    /* Ukuran ikon keranjang */
    .btn-blue i {
        font-size: 1.2rem;
    }

    /* Tambahkan CSS untuk hasil pencarian agar memiliki ukuran tetap 3:4 */
    .search-results .product {
        width: 300px;
        height: 400px; /* Sesuai rasio 3:4 */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    .search-results .product img {
        width: 90%;
        height: auto;
        max-height: 250px;
        object-fit: cover;
    }
</style>

   
</head>
<body>

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


<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>AKSESORIS</h1>
        <p>TRENDS IN FALL 24 FROM NEOCULT</p>
    </div>
</section>

<?php if (empty($query)): ?>
    <section class="products container">
        <h1 class="section-title text-center mb-5">Bracelet</h1>
        <div class="product-grid">
            <?php displayProducts($conn, 'Bracelet'); ?>
        </div>
    </section>

    <section class="products container">
        <h1 class="section-title text-center mb-5">Earring</h1>
        <div class="product-grid">
            <?php displayProducts($conn, 'Earring'); ?>
        </div>
    </section>

    <section class="products container">
        <h1 class="section-title text-center mb-5">Necklace</h1>
        <div class="product-grid">
            <?php displayProducts($conn, 'Necklace'); ?>
        </div>
    </section>

    <section class="products container">
        <h1 class="section-title text-center mb-5">Glasses</h1>
        <div class="product-grid">
            <?php displayProducts($conn, 'Glasses'); ?>
        </div>
    </section>

    <section class="products container">
        <h1 class="section-title text-center mb-5">Cupiece</h1>
        <div class="product-grid">
            <?php displayProducts($conn, 'Cupiece'); ?>
        </div>
    </section>
    <?php else: ?>
    <section class="products container">
        <h1 class="section-title text-center mb-5">Search Results</h1>
        <div class="product-grid search-results">
            <?php if (!empty($searchResults)): ?>
                <?php foreach ($searchResults as $item): ?>
                    <div class="product">
                        <img src="images/<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                        <h2><?php echo $item['name']; ?></h2>
                        <p><?php echo formatRupiah($item['price']); ?></p>
                        <a href="beli.php?id=<?php echo $item['id']; ?>&category=accessories" class="btn btn-pink">Beli Sekarang</a>
                        <a href="tambah_keranjang.php?id=<?php echo $item['id']; ?>&category=accessories" class="btn btn-blue"><i class="bi bi-cart"></i></a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No results found</p>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    function toggleSearchForm() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
        } else {
            searchForm.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const wishlistIcons = document.querySelectorAll('.wishlist-icon');

        wishlistIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const userId = 1;

                fetch('wishlist.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId + '&product_id=' + productId,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    this.classList.toggle('active');
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    function search(event) {
        event.preventDefault();
        const query = document.getElementById('searchInput').value;
        
        fetch(`aksesoris.php?query=${query}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.products').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>
</html>
