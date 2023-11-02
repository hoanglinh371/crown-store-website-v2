<?php
    session_start();
    require_once './configs/database.php';
    $cart_items = [];
    $total_items = 0;

    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
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
      INNER JOIN carts AS c ON ci.cart_id = c.id
      WHERE c.user_id = $userId";

        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Cart has items
            while ($row = mysqli_fetch_assoc($result)) {
                $cart_items[] = $row;
            }
        }

        $sql = "SELECT SUM(qty) AS total FROM cart_items WHERE cart_id = 1";
        $result = mysqli_query($connect, $sql);
        $total_items = mysqli_fetch_array($result)['total'];
    } else {
        $cart_items = [];
        $total_items = 0;
    }
?>

<header class="header">
    <a href="/" class="header__logo">
        <img src="./assets/images/crown.svg" alt="logo">
    </a>
    <nav class="header__nav-links">
        <?php if (!empty($_SESSION['display_name'])) { ?>
            <div class="nav-link">
                HELLO, <?php echo strtoupper($_SESSION['display_name']) ?>
            </div>
        <?php } ?>
        <a href="/shop" class="nav-link">SHOP</a>
        <a href="../contact.php" class="nav-link">CONTACT</a>
        <?php if (empty($_SESSION['user'])) { ?>
            <a href="../login.php" class="nav-link">LOGIN</a>
        <?php } else { ?>
            <a href="../processes/logout_process.php" class="nav-link">LOGOUT</a>
        <?php } ?>
        <div class="header__cart-icon">
            <img src="../assets/images/shopping-bag.svg" alt="shopping-icon">
            <span>
                <?php echo $total_items ?>
            </span>
        </div>
    </nav>
    <div class="header__cart-dropdown">
            <div class="cart-items">
                <?php foreach ($cart_items as $cart_item) { ?>
                    <div class="cart-item">
                        <img aria-label='image' src="<?php echo $cart_item['product_item_image'] ?>" alt=""/>
                        <div class="item-details">
                        <span class="name">
                            <?php echo $cart_item['product_name'] ?>
                        </span>
                            <span>
                            <?php echo $cart_item['qty'] ?> x <?php echo $cart_item['price'] ?>
                        </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <a href="../checkout.php" class="button">
            CHECKOUT
        </a>
    </div>
</header>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/index.js" type="text/javascript"></script>
