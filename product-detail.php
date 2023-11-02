<?php
    require_once './configs/database.php';
    $product_id = $_GET['product_id'];

    $sql = "SELECT *, pi.id as piid FROM products AS p
            INNER JOIN product_items AS pi
            ON p.id = pi.product_id
            inner join sizes as s
            on s.id = pi.size_id
            WHERE p.id = '$product_id'";

    $items = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Product Detail</title>
</head>

<body>
<?php
    require_once './components/header.php';
?>

<div class="products-container">
    <?php foreach ($items as $item) { ?>
        <div class="product-card">
            <img src="<?php echo $item['product_item_image'] ?>" alt="image" class="product-card__image">
            <div class="product-card__footer">
                <span class="product-card__name"><?php echo $item['size_value'] ?></span>
                <span class="product-card__name"><?php echo $item['price'] ?></span>
            </div>
            <a href="./processes/add_to_cart_process.php?product_item_id=<?php echo $item['piid'] ?>" class="button inverted">
                add to cart
            </a>
        </div>
    <?php } ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>


</html>
