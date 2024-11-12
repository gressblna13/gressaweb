<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mendapatkan parameter pencarian
$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// Mencari produk berdasarkan nama atau deskripsi yang sesuai dengan query pencarian
$sql = "SELECT * FROM productsaksesoris WHERE product_name LIKE '%$query%' OR product_description LIKE '%$query%'";
$result = mysqli_query($conn, $sql);

$searchResults = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
}

// Mengirimkan hasil pencarian dalam format JSON
header('Content-Type: application/json');
echo json_encode($searchResults);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Merriweather', serif;
            line-height: 1.6;
            background-color: #f8f9fa;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
            margin: 10px;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            max-width: 100%;
            aspect-ratio: 1 / 1; /* 1:1 aspect ratio */
            object-fit: cover;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
        .product-card h2 {
            font-size: 1.25rem;
            color: #333;
            margin: 10px 0;
        }
        .product-card p {
            color: #777;
            font-size: 1rem;
            margin: 10px 0;
        }
        .product-card a {
            text-decoration: none;
            color: inherit;
        }
        .product-card a:hover h2,
        .product-card a:hover p {
            color: #000;
        }
        .btn-primary {
            background-color: #67a3d9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #b08d79;
        }
        .container {
            padding: 20px;
        }
        .section-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 0;
            text-align: center;
            position: relative;
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
        .search-results {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="section-title">Search Results</h1>
    <div class="search-results" id="searchResults"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchResults = <?php echo json_encode($searchResults); ?>;
        const resultsContainer = document.getElementById('searchResults');
        
        if (searchResults.length > 0) {
            searchResults.forEach(item => {
                const productHTML = `
                    <div class="product-card">
                        <img src="images/${item.product_image}" alt="${item.product_name}">
                        <h2>${item.product_name}</h2>
                        <p>${formatRupiah(item.product_price)}</p>
                        <a href="beli.php?id=${item.id}&category=accessories" class="btn btn-primary mb-2">Beli Sekarang</a>
                        <a href="tambah_keranjang.php?id=${item.id}&category=accessories" class="btn btn-secondary"><i class="bi bi-cart"></i></a>
                    </div>`;
                resultsContainer.innerHTML += productHTML;
            });
        } else {
            resultsContainer.innerHTML = '<p class="text-center">No results found</p>';
        }
    });

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    }
</script>

</body>
</html>
