<?php
    session_start();

    require_once '../configs/database.php';

    $userId = $_SESSION['user'];
    $date = date("Y-m-d");
    $orderTotal = $_GET['total'];
    $status = 1;

    // Insert order details into "orders" table
    $sql = "INSERT INTO orders (user_id, order_date, order_total, order_status_id) 
            VALUES ('$userId', '$date', '$orderTotal', '$status')";
    mysqli_query($connect, $sql);

    // Retrieve the last inserted order ID
    $orderId = mysqli_insert_id($connect);

    // Insert order line items into "order_line" table
    $cartItemsQuery = "SELECT ci.product_item_id, ci.qty, pi.price
                       FROM carts AS c
                       INNER JOIN cart_items AS ci ON c.id = ci.cart_id
                       INNER JOIN product_items AS pi ON ci.product_item_id = pi.id
                       WHERE c.user_id = '$userId'";
    $cartItemsResult = mysqli_query($connect, $cartItemsQuery);

    while ($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
        $productItemId = $cartItem['product_item_id'];
        $quantity = $cartItem['qty'];
        $price = $cartItem['price'];

        $sql = "INSERT INTO order_lines (order_id, product_item_id, qty, price) 
                VALUES ('$orderId', '$productItemId', '$quantity', '$price')";
        mysqli_query($connect, $sql);
    }

    // Clear the cart items after inserting order line items
    $clearCartQuery = "DELETE FROM cart_items WHERE cart_id IN (SELECT id FROM carts WHERE user_id = '$userId')";
    mysqli_query($connect, $clearCartQuery);

    // Redirect or perform any other desired action
    header("Location: ../index.php");
?>