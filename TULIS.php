<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Graphics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Merriweather', serif;
        }
        body {
            line-height: 1.6;
        }
        .section-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .product {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            max-width: 100%;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #67a3d9;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background: #b08d79;
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
    </style>
</head>
<body>

<section class="products">
    <h1 class="section-title">T-Shirts</h1>
    <div class="product-grid">
        <div class="product">
            <img src="images/t1.jpg" alt="Product 1">
            <h2>T-Shirt 1</h2>
            <p>$899.000</p>
        </div>
        <div class="product">
            <img src="images/t2.jpg" alt="Product 2">
            <h2>T-Shirt 2</h2>
            <p>$865.00</p>
        </div>
        <div class="product">
            <img src="images/t3.jpg" alt="Product 3">
            <h2>T-Shirt 3</h2>
            <p>$480.00</p>
        </div>
        <div class="product">
            <img src="images/t4.jpg" alt="Product 4">
            <h2>T-Shirt 4</h2>
            <p>$635.00</p>
        </div>
    </div>
</section>

<section class="products">
    <h1 class="section-title">Hoodies</h1>
    <div class="product-grid">
        <div class="product">
            <img src="images/h1.jpg" alt="Product 1">
            <h2>Hoodie 1</h2>
            <p>$899.000</p>
        </div>
        <div class="product">
            <img src="images/h2.jpg" alt="Product 2">
            <h2>Hoodie 2</h2>
            <p>$865.00</p>
        </div>
        <div class="product">
            <img src="images/h3.jpg" alt="Product 3">
            <h2>Hoodie 3</h2>
            <p>$480.00</p>
        </div>
        <div class="product">
            <img src="images/h4.jpg" alt="Product 4">
            <h2>Hoodie 4</h2>
            <p>$635.00</p>
        </div>
    </div>
</section>

<section class="products">
    <h1 class="section-title">Sweatshirts</h1>
    <div class="product-grid">
        <div class="product">
            <img src="images/s1.jpg" alt="Product 1">
            <h2>Sweatshirt 1</h2>
            <p>$480.00</p>
        </div>
        <div class="product">
            <img src="images/s2.jpg" alt="Product 2">
            <h2>Sweatshirt 2</h2>
            <p>$295.00</p>
        </div>
        <div class="product">
            <img src="images/s3.jpg" alt="Product 3">
            <h2>Sweatshirt 3</h2>
            <p>$930.00</p>
        </div>
        <div class="product">
            <img src="images/s4.jpg" alt="Product 4">
            <h2>Sweatshirt 4</h2>
            <p>$385.00</p>
        </div>
    </div>
</section>

<section class="products">
    <h1 class="section-title">Tank Tops</h1>
    <div class="product-grid">
        <div class="product">
            <img src="images/top1.jpg" alt="Product 1">
            <h2>Tank Top 1</h2>
            <p>$480.00</p>
        </div>
        <div class="product">
            <img src="images/top2.jpg" alt="Product 2">
            <h2>Tank Top 2</h2>
            <p>$295.00</p>
        </div>
        <div class="product">
            <img src="images/top3.jpg" alt="Product 3">
            <h2>Tank Top 3</h2>
            <p>$930.00</p>
        </div>
        <div class="product">
            <img src="images/top4.jpg" alt="Product 4">
            <h2>Tank Top 4</h2>
            <p>$385.00</p>
        </div>
    </div>
</section>

<footer class="mt-4">
    <p>&copy; 2024 Neocult. Semua hak cipta dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
