<?php
    require_once '../configs/database.php';

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check password = confirm_password
    if (strcmp($password, $confirm_password) != 0) {
        header("location:../login.php?error=password-not-the-same");
    }

    // Check email has been used
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $response = mysqli_query($connect, $sql);

    if (mysqli_num_rows($response)) {
        header("location:../login.php?error=email-is-existed");
    }

    // If pass, create record in db then redirect login.php
    $sql = "INSERT INTO users (first_name, last_name, email, password, phone, address)
            VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$address')";
    mysqli_query($connect, $sql);

    $user_id = mysqli_insert_id($connect);

    $sql = "INSERT INTO carts (user_id) VALUES ('$user_id')";
    mysqli_query($connect, $sql);

    header("location:../login.php");