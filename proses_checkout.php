<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['product_id']) && !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['quantity']) && !empty($_POST['total_price']) && !empty($_POST['payment_method_id'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
        $total_price = mysqli_real_escape_string($conn, $_POST['total_price']);
        $payment_method_id = mysqli_real_escape_string($conn, $_POST['payment_method_id']);

        $query = "INSERT INTO orders (product_id, name, address, phone, quantity, total_price, payment_method_id) VALUES ('$product_id', '$name', '$address', '$phone', '$quantity', '$total_price', '$payment_method_id')";
        if (mysqli_query($conn, $query)) {
            echo "<!DOCTYPE html>
                  <html lang='en'>
                  <head>
                      <meta charset='UTF-8'>
                      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                      <title>Order Confirmation</title>
                      <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css' rel='stylesheet'>
                      <style>
                          body {
                              font-family: Arial, sans-serif;
                              margin: 0;
                              padding: 0;
                              display: flex;
                              justify-content: center;
                              align-items: center;
                              height: 100vh;
                              background-color: #f8f9fa;
                          }

                          .confirmation-container {
                              text-align: center;
                              background-color: #ffffff;
                              padding: 20px;
                              border-radius: 8px;
                              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                              border: 2px solid #ff69b4;
                          }

                          .confirmation-container h1 {
                              font-size: 2.5em;
                              color: #ff69b4;
                              margin-bottom: 20px;
                          }

                          .confirmation-container p {
                              font-size: 1.2em;
                              color: #6c757d;
                              margin-bottom: 10px;
                          }

                          .confirmation-container a {
                              display: inline-block;
                              margin-top: 20px;
                              text-decoration: none;
                              color: #007bff;
                              font-weight: bold;
                              font-size: 1.1em;
                          }

                          .confirmation-container a:hover {
                              color: #0056b3;
                          }

                          .contact-info {
                              margin-top: 30px;
                          }

                          .contact-info a {
                              margin: 0 10px;
                              font-size: 1.5em;
                              color: #6c757d;
                              text-decoration: none;
                          }

                          .contact-info a:hover {
                              color: #ff69b4;
                          }

                          .payment-image {
                              margin-bottom: 20px;
                          }
                      </style>
                  </head>
                  <body>
                      <div class='confirmation-container'>
                          <img src='images/scen.png' alt='Payment QR Code' class='payment-image' width='200'>
                          <h1>Thank You!</h1>
                          <p>Please scan this barcode to your preferred Q-RIS to continue to payment!</p>
                          <a href='uas_manies.php' class='btn btn-primary'>Kembali ke Halaman Utama</a>
                          <div class='contact-info'>
                              <a href='https://www.instagram.com/grassblnamunthe' target='_blank'><i class='bi bi-instagram'></i></a>
                              <a href='https://wa.me/6281997513792' target='_blank'><i class='bi bi-whatsapp'></i></a>
                              <a href='mailto:munthegrasya@gmail.com'><i class='bi bi-envelope'></i></a>
                          </div>
                      </div>
                      <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
                      <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.js'></script>
                  </body>
                  </html>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Harap isi semua data yang diperlukan.";
    }
} else {
    echo "Invalid request.";
}
?>
