<?php
$title = "ByBeauty";
include('navbar.php');
include('conn.php');

$select = "SELECT * FROM `products`";
$result = mysqli_query($conn, $select);

$product_count = mysqli_num_rows($result);

?>
<div class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">Skincare Essentials</h1>
            <p class="lead my-3">Welcome to ByBeauty, your ultimate destination for premium skincare solutions. At ByBeauty, we believe in the power of natural ingredients and cutting-edge science to bring you products that enhance your natural beauty. Discover a radiant, healthier you with our meticulously crafted skincare essentials.</p>
        </div>
    </div>
</div>
<div class="album py-5 bg-body-tertiary">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
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
                                    <a href="product.php?id=<?= $product[0] ?>" class="btn btn-outline-secondary">Add to Cart</a>
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
</div>
<?php include('footer.php') ?>