<?php
    require_once './configs/database.php';
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products AS p
            INNER JOIN product_items AS pi
            ON p.id = pi.product_id
            WHERE p.id = '$product_id'";
    $items = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Product Detail</title>
</head>
<body>
<?php
    require_once './components/header.php';
?>

<div class="products-container">


    <!--  Các biến thể của sản phẩm  -->
    <?php foreach ($items as $item) { ?>
        <div class="product-card">
            <img src="<?php echo $item['product_item_image'] ?>" alt="image" class="product-card__image">
            <div class="product-card__footer">
                <span class="product-card__name"><?php echo $item['product_name'] ?></span>
                <span class="product-card__price">
                    <?php echo '$' . $item['price'] ?>
                </span>
            </div>
            <a
                href="/processes/add_to_cart_process.php?product_item_id=<?php echo $item['id'] ?>"
                class="button inverted"
            >
                Add to Cart
            </a>
        </div>
    <?php } ?>
</div>
</body>
</html>
