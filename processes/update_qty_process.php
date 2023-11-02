<?php
    session_start();
    $cart_item_id = $_GET['cart_item_id'];
    $type = $_GET['type'];

    require_once '../configs/database.php';
    $sql = "SELECT qty FROM cart_items WHERE id = '$cart_item_id'";
    $result = mysqli_query($connect, $sql);
    $qty = mysqli_fetch_array($result)[0];

    switch ($type) {
        case 'dec': {
            if ($qty == 1) {
                $sql = "DELETE FROM cart_items WHERE id = '$cart_item_id'";
            } else {
                $sql = "UPDATE cart_items SET qty = qty - 1 WHERE id = '$cart_item_id'";
            }
            break;
        }
        case 'inc': {
            $sql = "UPDATE cart_items SET qty = qty + 1 WHERE id = '$cart_item_id'";
            break;
        }
        case 'remove': {
            $sql = "DELETE FROM cart_items WHERE id = $cart_item_id";
            break;
        }


        default:
            echo "NOT INCLUDE ACTION";
    }

    mysqli_query($connect, $sql);
    header('location:../checkout.php');
