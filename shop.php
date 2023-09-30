<?php
    $category = $_GET['category'];
    require_once './configs/database.php';
    $sql = "SELECT id FROM categories WHERE category_name = '$category'";
    $result = mysqli_query($connect, $sql);
    $category_id = mysqli_fetch_array($result)[0];
    $sql = "SELECT * FROM products WHERE category_id = $category_id";
    $items = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Shop</title>
</head>
<body>
<?php
    require_once './components/header.php';
?>

<div class="products-container">
    <?php foreach ($items as $item) { ?>
        <div class="product-card">
            <img src="<?php echo $item['product_image'] ?>" alt="image" class="product-card__image">
            <div class="product-card__footer">
                <span class="product-card__name"><?php echo $item['product_name'] ?></span>
            </div>
            <a href="./product-detail.php?product_id=<?php echo $item['id'] ?>" class="button inverted">
                View
            </a>
        </div>
    <?php } ?>
</div>
</body>
</html>
