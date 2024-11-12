<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "uas_manis");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 2, ',', '.');
}

$user_id = 1; // Ganti dengan user ID yang sesuai

$categories = [
    'trend' => 'productstrend',
    'sepatuklasik' => 'productssepatuklasik',
    'pakaianklasik' => 'prakaianklasik',
    'aksesori' => 'productsaksesori',
    'grafik' => 'productsgrafik'
];

$sqlParts = [];
foreach ($categories as $category => $tableName) {
    $sqlParts[] = "SELECT wishlist.product_id, '$category' AS category, $tableName.name, $tableName.price, $tableName.image
                   FROM wishlist
                   LEFT JOIN $tableName ON wishlist.product_id = $tableName.id AND wishlist.category = '$category'
                   WHERE wishlist.user_id = $user_id";
}

$sql = implode(" UNION ", $sqlParts);
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #aec6cf; /* Warna biru pastel */
            border-color: #aec6cf;
        }

        .btn-primary:hover {
            background-color: #98b2c3; /* Warna biru pastel sedikit lebih gelap */
            border-color: #98b2c3;
        }

        .btn-danger {
            background-color: #ffd1dc; /* Warna merah muda pastel */
            border-color: #ffd1dc;
        }

        .btn-danger:hover {
            background-color: #ffb6c1; /* Warna merah muda pastel sedikit lebih gelap */
            border-color: #ffb6c1;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="my-5">Wishlist Saya</h1>
        <div class="row">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-3">';
                    echo '<div class="card mb-4">';
                    echo '<img src="images/' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text">' . formatRupiah($row["price"]) . '</p>';
                    echo '<a href="beli.php?id=' . $row["product_id"] . '&category=' . $row["category"] . '" class="btn btn-primary">Beli Sekarang</a>';
                    echo '<a href="hapus_wishlist.php?id=' . $row["product_id"] . '&category=' . $row["category"] . '" class="btn btn-danger">Hapus</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Wishlist kosong.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>
