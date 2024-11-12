<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags and other head content -->
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Form and other body content -->
        <form method="post" action="">
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="text" name="first_name" class="form-control form-control-user" placeholder="First Name">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="last_name" class="form-control form-control-user" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-user" placeholder="Email Address">
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                </div>
                <div class="col-sm-6">
                    <input type="password" name="confirm_password" class="form-control form-control-user" placeholder="Repeat Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
        </form>
        <!-- Additional content -->
    </div>
</body>
</html>
