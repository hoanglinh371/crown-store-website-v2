<?php
require_once './configs/database.php';
$product_id = $_GET['product_id'];
$color = isset($_GET['color']) ? $_GET['color'] : 1;
$sql = "SELECT * FROM products AS p
            INNER JOIN product_items AS pi
            ON p.id = pi.product_id
            inner join sizes as s
            on s.id = pi.size_id
            inner join colors as c
            on c.id = pi.color_id
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
    $sql = "SELECT product_image, product_name, product_desc FROM products WHERE id = $product_id";
    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_array($result);

    $sql1 = "SELECT color_id, color_hex_code FROM product_items as pi
                INNER JOIN colors as c
                on pi.color_id = c.id
                inner join products as p
                on pi.product_id = p.id
                where p.id = '$product_id'
                Group By color_id";


    $colors = mysqli_query($connect, $sql1);

    $sql_color = " SELECT * FROM product_items as pi
                INNER JOIN colors as c
                on pi.color_id = c.id
                inner join products as p
                on pi.product_id = p.id
                where p.id = '$product_id'";

    $result_color = mysqli_query($connect, $sql_color);
    $row_color = mysqli_fetch_array($result_color)

        // $row1 = mysqli_fetch_array($result1);

        // echo $row[0];
        // echo $row1[1];
        ?>
    <!-- Hiển thị các slide màu  -->
    <!-- <div class="carousel-item active" data-bs-interval="10000">
        <img src="<?php echo $item['product_item_image'] ?>" class="d-block w-full" alt="image">
    </div> -->

    <div class="row">
        <div class="product-single_wrapper gap-4 col-6">
            <div class="product-single__images w-full">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- <?php foreach ($items as $item) { ?> -->
                            <div class="carousel-item w-full active">
                                <img src="<?php echo $item['product_item_image'] ?>" class="d-block w-full" alt="image">
                            </div>
                            <!-- <?php } ?> -->
                        <?php foreach ($items as $item) { ?>
                            <div class="carousel-item w-full">
                                <img src="<?php echo $item['product_item_image'] ?>" class="d-block w-full" alt="image">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-single_sumary mb-4 col-6">
            <h1 class="product-single__title">
                <?php echo $row[1] ?>
            </h1>
            <p class="product-single__description mb-4">
                <?php echo $row[2] ?>
            </p>
            <div class="product-single__color mb-4 d-flex gap-2">
                <?php foreach ($colors as $item) { ?>
                    <a style="background-color:<?php echo $item['color_hex_code'] ?>;width: 40px;height: 25px;"
                        class="d-block rounded-pill"
                        href="product-detail.php?product_id=<?php echo $product_id ?>&color=<?php echo $item['color_id'] ?>"></a>
                <?php } ?>
            </div>
            <?php echo '$' . $row_color['price'] ?>
        </div>
    </div>
    </div>
    <div class="products-container mt-4">
        <!-- <?php foreach ($items as $item) { ?>
            <div class="product-card">
                <span class="product-card__color">
                    <?php echo $item['color_name'] ?>
                </span>
                <img src="<?php echo $item['product_item_image'] ?>" alt="image" class="product-card__image">
                <div class="product-card__footer">
                    <span class="product-card__size">
                        <?php echo $item['size_value'] ?>
                    </span>
                    <span class="product-card__price">
                        <?php echo '$' . $item['price'] ?>
                    </span>

                </div>
                <a href="add_to_cart_process.php?id=<?php echo $item['id'] ?>" class="button inverted">
                    Add to Cart
                </a>
            </div>
        <?php } ?> -->
    </div>

    <!-- <a href="product-detail.php?product_id=<?php echo $product_id ?>&color=<?php echo 'red' ?>">red</a> -->

    <!-- Các biến thể của sản phẩm -->
    <!--
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($items as $item) { ?>
                <div class="carousel-item active" data-bs-interval="10000">
                    <img width="900px" height="700px" src="<?php echo $item['product_item_image'] ?>"
                        class="d-block w-100 product-card__image" style="object-fit:cover;" alt="image">
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</html>
