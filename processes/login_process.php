<?php
    require_once '../configs/database.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $response = mysqli_query($connect, $sql);

    if (!mysqli_num_rows($response)) {
        header("location:../login.php?error=not-find-account");
    } else {
        session_start();
        $row = mysqli_fetch_assoc($response);
        $userId = $row['id'];
        $_SESSION['user'] = $userId;

        header("location:../index.php");
    }