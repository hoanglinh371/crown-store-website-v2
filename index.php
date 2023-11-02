<?php
    require_once './configs/database.php';
    $sql = "SELECT * FROM categories";
    $categories = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/index.css?v=<?php echo time() ?>" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<?php
    require_once './components/header.php';
    echo "user id" . $_SESSION['user'];
?>

<div class="directories-container">
    <?php foreach ($categories as $category) { ?>
        <a href="<?php echo './shop.php?category=' . $category['category_name'] ?>" class="directory-item">
            <div
                class="directory-item__bg-image"
                style="background-image: url(<?php echo $category['category_image'] ?>)"
            ></div>
            <div class="directory-item__body">
                <h2><?php echo $category['category_name'] ?></h2>
                <p>Shop Now</p>
            </div>
        </a>
    <?php } ?>
</div>
</body>
</html>
