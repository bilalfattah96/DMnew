<?php
$title = "Products";

include('navbar.php');
include('conn.php');



$select = "SELECT * FROM `products`";
$result = mysqli_query($conn, $select);

$product_count = mysqli_num_rows($result);

?>
<div class="container">
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-5">
    <?php

    $i = 0;
    while ($i < $product_count) {
        $product = mysqli_fetch_array($result);
    ?>
        <div class="col">
            <div class="card shadow-sm">
                <img src="<?= $product['image'] ?>" class="w-100" height="225" alt="">
                <div class="card-body">
                    <p class="card-text"><?= $product['description'] ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="product.php?id=<?= $product['id'] ?>" class="btn btn-outline-secondary">Add to Cart</a>
                        </div>
                        <small class="text-body-secondary fs-4"><?= "$" . $product['price'] ?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php
        $i++;
    }
    ?>

</div>

</div>


<?php include('footer.php') ?>