<?php
    require_once '../configs/database.php';
    $product_item_id = $_GET['product_item_id'];
    $sql = "SELECT * FROM cart_items where product_item_id = '$product_item_id'";
    $isExisted = mysqli_query($connect, $sql);

    if (mysqli_num_rows($isExisted) > 0) {
        $sql = "UPDATE cart_items SET qty = qty + 1 WHERE product_item_id = '$product_item_id'";
    } else {
        $sql = "INSERT INTO cart_items (cart_id, product_item_id, qty)
            VALUES (1, $product_item_id, 1)";
    }

    mysqli_query($connect, $sql);

    header('location:../product-detail.php?product_id=10');