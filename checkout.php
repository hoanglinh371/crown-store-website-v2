<?php
    require_once './components/header.php';
    require_once './configs/database.php';
    $sql = "SELECT
            ci.id,
            ci.cart_id,
            ci.product_item_id,
            ci.qty, p_i.price,
            p_i.product_item_image,
            p.product_name
        FROM cart_items AS ci
        INNER JOIN product_items AS p_i ON ci.product_item_id = p_i.id
        INNER JOIN products AS p ON p_i.product_id = p.id
        WHERE ci.cart_id = 1";
    $cart_items = mysqli_query($connect, $sql);
    $total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Checkout</title>
</head>
<body>
<?php
    require_once './components/header.php';
?>

<div class="checkout-container">
    <div class="checkout__header">
        <div class="checkout__header-block">
            <span>Product</span>
        </div>
        <div class="checkout__header-block">
            <span>Description</span>
        </div>
        <div class="checkout__header-block">
            <span>Quantity</span>
        </div>
        <div class="checkout__header-block">
            <span>Price</span>
        </div>
        <div class="checkout__header-block">
            <span>Remove</span>
        </div>
    </div>
    <?php foreach ($cart_items as $cart_item) { ?>
        <div class="cart-container">
            <div class="image-container">
                <img src="<?php echo $cart_item['product_item_image'] ?>" alt=""/>
            </div>
            <span class="name"><?php echo $cart_item['product_name'] ?></span>
            <div class="quantity">
                <a href="./processes/update_qty_process.php?cart_item_id=<?php echo $cart_item['id'] ?>&type=dec"
                   class="arrow">
                    <img src="./assets/images/chevron-left-solid.svg" alt="dec-icon"/>
                </a>
                <span class="value">
                    <?php echo $cart_item['qty'] ?>
                </span>
                <a
                    href="./processes/update_qty_process.php?cart_item_id=<?php echo $cart_item['id'] ?>&type=inc"
                    class="arrow"
                >
                    <img src="./assets/images/chevron-right-solid.svg" alt="inc-icon"/>
                </a>
            </div>
            <span class="price">
                <?php
                    echo '$' . $cart_item['price'];
                    $total += $cart_item['price'] * $cart_item['qty'];
                ?>
            </span>
            <a
                href="./processes/update_qty_process.php?cart_item_id=<?php echo $cart_item['id'] ?>&type=remove"
                class="remove-btn"
            >
                <img src="./assets/images/xmark-solid.svg" alt="remove-icon"/>
            </a>
        </div>
    <?php } ?>
    <span class="total">Total: <?php echo '$' . $total ?></span>
</div>
</body>
</html>
