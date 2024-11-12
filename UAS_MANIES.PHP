<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container-wrapper {
            max-width: calc(100% - 20px);
            margin: 0 auto;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .navbar-nav .nav-link {
    color: #555;
    font-weight: bold;
    padding: 0 15px; /* Tambahkan padding horizontal */
}

.hero-text h1 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 15px; /* Tambahkan jarak bawah */
}

.hero-text p {
    font-size: 1.25rem;
    margin-bottom: 20px; /* Tambahkan jarak bawah */
}

.product h5 {
    font-weight: bold;
    text-align: center;
    margin-top: 10px;
    padding-top: 10px; /* Tambahkan padding atas */
}
/* About Us Section */
.about-us {
    margin-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #f0f8ff;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.about-us .about-image {
    flex: 1;
    max-width: 300px;
    margin-right: 20px;
}

.about-us .about-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.about-us .about-content {
    flex: 2;
}

.about-us .about-content h3 {
    font-size: 1.8em;
    margin-bottom: 10px;
    color: #333;
}

.about-us .about-content p {
    font-size: 1em;
    color: #555;
    line-height: 1.6;
}

        /* Hero Section */
        .hero {
            position: relative;
            text-align: center;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            overflow: hidden;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            text-align: center;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .hero-text p {
            font-size: 1.25rem;
        }

        .shop-now {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
        }

        .shop-now:hover {
            background-color: #0056b3;
            color: #fff;
        }

        /* Collection Section */
        .section-title {
        font-weight: 700;
        color: #333;
    }

    .section-subtitle {
        font-size: 1.5rem;
        color: #666;
    }

    .btn-outline-secondary {
        border-color: #8B4513;
        color: #8B4513;
    }

    .btn-outline-secondary:hover {
        background-color: #8B4513;
        color: white;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .card-text {
        font-size: 0.9rem;
    }

    .zoom-card {
        transition: transform 0.3s ease;
    }

    .zoom-card:hover {
        transform: scale(1.05);
    }

    .shadow-link {
        text-decoration: none;
        color: #8B4513;
    }

    .shadow-link:hover {
        text-decoration: underline;
        color: #B57C4A;
    }

        /* Footer Styling */
        footer {
            background-color: #b6dcec;
            padding: 2rem 0;
        }

        footer .btn-floating {
            background-color: #333;
            color: white;
        }

        footer .btn-floating:hover {
            background-color: #555;
        }

        footer .social-media a {
            color: white;
            font-size: 1.25rem;
        }
    </style>
</head>

<body>
    <div class="container-wrapper">
        <!-- Header Section -->
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

        <!-- Hero Section -->
        <section class="hero mt-4 mb-5">
            <div class="hero-overlay animate__animated animate__fadeIn"></div>
            <img src="images/enhp.png" alt="Hero Image" class="hero-image animate__animated animate__zoomIn">
            <div class="hero-text">
                <h1 class="animate__animated animate__fadeInUp">CARAT'S FASHION</h1>
                <p class="animate__animated animate__fadeInUp">Minimalist wardrobe you wished for!</p>
                <a href="LATEST.PHP" class="shop-now animate__animated animate__fadeInUp">Shop Now</a>
            </div>
        </section>

        <!-- Collection Section -->
        <section class="container-fluid">
    <h1 class="section-title text-center mb-4" style="font-size: 2.5rem; color: #333;">COLLECTION AT CARAT'S</h1>
    <h3 class="section-subtitle text-center mb-3" style="font-size: 1.5rem; color: #555;">OUR BRAND AMBASSADOR</h3>
    <p class="text-center mb-4">
        <a href="trend.php" class="btn btn-outline-secondary shadow-link">See Other Products</a>
    </p>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <a href="pakaianklasik.php" class="text-decoration-none">
                <div class="card h-100 shadow-sm zoom-card">
                    <img src="images/trend6.jpg" class="card-img-top" alt="Urban Stealth Jacket">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark">Urban Stealth Jacket</h5>
                        <p class="card-text text-muted">$20.00</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="pakaianklasik.php" class="text-decoration-none">
                <div class="card h-100 shadow-sm zoom-card">
                    <img src="images/trend2.jpg" class="card-img-top" alt="Shadow Racer Jacket">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark">Shadow Racer Jacket</h5>
                        <p class="card-text text-muted">$25.00</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="pakaianklasik.php" class="text-decoration-none">
                <div class="card h-100 shadow-sm zoom-card">
                    <img src="images/trend3.jpg" class="card-img-top" alt="Shadow Racer Jacket">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark">Shadow Racer Jacket</h5>
                        <p class="card-text text-muted">$25.00</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="pakaianklasik.php" class="text-decoration-none">
                <div class="card h-100 shadow-sm zoom-card">
                    <img src="images/trend4.jpg" class="card-img-top" alt="Classic Denim Jacket">
                    <div class="card-body text-center">
                        <h5 class="card-title text-dark">Classic Denim Jacket</h5>
                        <p class="card-text text-muted">$30.00</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<!-- About Us Section -->
<section class="about-us container">
    <div class="about-image">
        <img src="images/shua1.jpg" alt="About Us" class="img-fluid">
    </div>
    <div class="about-content">
        <h3>About Us</h3>
        <p>Welcome to Neocult, where fashion meets innovation. Our collection of stylish and unique pieces is designed to make you stand out. We believe in empowering individuals through fashion and providing high-quality, sustainable clothing options.</p>
        <p>Neocult represents a new wave of culture, blending contemporary trends with timeless elegance. Our commitment to sustainability and quality is at the heart of everything we do, ensuring that our pieces not only look good but also make you feel good.</p>
        <p>We are proud to introduce Joshua Hong from Seventeen as our brand ambassador. With his impeccable style and influence in the fashion world, Joshua perfectly embodies the spirit of Neocult, bringing a fresh and dynamic edge to our brand.</p>
        <p>Join us on this journey and be a part of the Neocult revolution, where fashion is not just about clothing, but a lifestyle and a statement.</p>
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
    </div>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
