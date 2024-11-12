<?php
// Mulai sesi
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uas_manis");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = '';
$success_message = '';

// Proses login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];

        if (password_verify($password, $stored_password)) {
            $_SESSION['username'] = $username;
            header("Location: UAS_MANIES.PHP");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }
}

// Proses signup
if (isset($_POST['signup'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password == $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $success_message = "Signup successful! Please log in.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        $error_message = "Passwords do not match.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d3b8ae; /* Brown pastel */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Merriweather', serif;
            overflow: hidden;
        }
        .container {
            background: #fff;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            overflow: hidden;
        }
        .form-container {
            padding: 20px; /* Mengurangi padding */
            width: 50%;
        }
        .form-container h2 {
            margin-bottom: 10px; /* Mengurangi margin bawah */
        }
        .form-control {
            margin-bottom: 10px; /* Mengurangi margin bawah */
            border-radius: 5px;
        }
        .btn-login, .btn-signup {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            transition: background 0.3s;
        }
        .btn-login {
            background-color: #a2d5f2; /* Blue pastel */
        }
        .btn-login:hover {
            background-color: #89c2d9;
        }
        .btn-signup {
            background-color: #f2a2d5; /* Pink pastel */
        }
        .btn-signup:hover {
            background-color: #d989c2;
        }
        .social-login a {
            font-size: 24px;
            margin: 0 10px;
            color: #333;
            transition: color 0.3s;
        }
        .social-login a:hover {
            color: #007bff;
        }
        .logo img {
            width: 150px;
            height: auto;
            margin-bottom: 10px; /* Mengurangi margin bawah */
        }
        .info-container {
            background: linear-gradient(to right, #f2a2d5, #a2d5f2); /* Gradient pink to blue pastel */
            color: white;
            padding: 20px; /* Mengurangi padding */
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .info-container h2 {
            font-size: 30px; /* Mengurangi ukuran font */
            margin-bottom: 10px; /* Mengurangi margin bawah */
        }
        .info-container p {
            font-size: 16px; /* Mengurangi ukuran font */
            text-align: center;
        }
        .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }
        .nav-tabs {
            justify-content: center;
            margin-bottom: 10px; /* Mengurangi margin bawah */
        }
        .nav-tabs .nav-link {
            color: #333;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 5px;
            transition: background 0.3s;
        }
        .nav-tabs .nav-link.active {
            background-color: #d3b8ae; /* Brown pastel */
            color: white;
        }
        /* Custom style for autocomplete dropdown */
        input::-webkit-autofill,
        input::-webkit-autofill:hover,
        input::-webkit-autofill:focus,
        input::-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #333 !important;
        }
        .form-control:focus {
            box-shadow: none;
        }
        .form-control::placeholder {
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Log in</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="signup" aria-selected="false">Sign up</button>
                </li>
            </ul>
            <?php if ($error_message): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <div class="notification" id="notification">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <h2>Welcome Back!</h2>
                    <form action="USERS.PHP" method="POST">
                        <div class="mb-3">
                            <label for="login-username" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="login-username" name="username" placeholder="Masukkan nama pengguna" required>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login-password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" name="login" class="btn-login">Log in</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                    <h2>Join Us!</h2>
                    <form action="USERS.PHP" method="POST">
                        <div class="mb-3">
                            <label for="signup-email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="signup-email" name="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="signup-username" name="username" placeholder="Masukkan nama pengguna" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signup-password" name="password" placeholder="Masukkan password" required>
                        </div>
                        <div class="mb-3">
                            <label for="signup-confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="signup-confirm-password" name="confirm_password" placeholder="Konfirmasi password" required>
                        </div>
                        <button type="submit" name="signup" class="btn-signup">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="info-container">
            <h2>Join Us!</h2>
            <p>Sign up to access exclusive features and stay updated with the latest news.</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menampilkan notifikasi sementara
        window.onload = function() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'block';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000); // Notifikasi akan hilang setelah 3 detik
            }
        };
    </script>
</body>
</html>
