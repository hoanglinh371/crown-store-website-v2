<?php
    require_once '../configs/database.php';

    session_start();

    $product_item_id = $_GET['product_item_id'];
    $userId = $_SESSION['user'];

    $sql = "SELECT id FROM carts WHERE user_id = $userId";
    $res = mysqli_query($connect, $sql);
    $card_id = mysqli_fetch_array($res)[0];

    $sql = "SELECT * FROM cart_items where product_item_id = '$product_item_id' and cart_id = '$card_id'";
    $isExisted = mysqli_query($connect, $sql);

    if (mysqli_num_rows($isExisted) > 0) {
        die("true");
        $sql = "UPDATE cart_items SET qty = qty + 1 WHERE product_item_id = '$product_item_id'";
    } else {
        $sql = "INSERT INTO cart_items (cart_id, product_item_id, qty)
            VALUES ($card_id, $product_item_id, 1)";
    }

    mysqli_query($connect, $sql);

    header('location: ' . $_SERVER['HTTP_REFERER']);