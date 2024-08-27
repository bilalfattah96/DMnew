<?php
ob_start();
$title = "Cart";
include('navbar.php');
include('conn.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
if (isset($_POST['update'])) {
    foreach ($_POST['quantity'] as $p_id => $quantity) {
        $update = "UPDATE `cart` SET `p_quantity`='$quantity' WHERE id='$p_id'";
        $result = mysqli_query($conn, $update);
        if (!$result) {
            echo "Error";
        }
    }
    header('Location: cart.php');
}


$id = $_SESSION['username'];
$select = "SELECT * FROM cart WHERE u_id='$id'";
$result = mysqli_query($conn, $select);
$products_count = mysqli_num_rows($result);
$count = 0;




?>

<div class="container">
    <h1>Shopping Cart</h1>
    <form action="" method="post">
        <table class="table">
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($products_count == 0) {
                    echo "<tr><td colspan='5' style='text-align:center;'>You have no products added in your Shopping Cart</td></tr>";
                } else {
                    while ($product = mysqli_fetch_array($result)) {
                        $total_price = $product['p_price'] * $product['p_quantity'];
                        $count += $total_price;
                ?>
                        <tr>
                            <td>
                                <a href="product.php?id=<?= $product['id'] ?>">
                                    <img src="<?= $product['p_image'] ?>" width="60" height="50" alt="<?= $product['p_title'] ?>">
                                </a>
                            </td>
                            <td>
                                <a class="text-secondary" href="product.php?id=<?= $product['id'] ?>"><?= $product['p_title'] ?></a>
                                <br>
                                <a class="text-secondary fs-6" href="delete.php?remove=<?= $product['id'] ?>">Remove</a>
                            </td>
                            <td class="price">&dollar;<?= $product['p_price'] ?></td>
                            <td>
                                <input type="number" name="quantity[<?= $product['id'] ?>]" value="<?= $product['p_quantity'] ?>" required>
                            </td>
                            <td class="price">&dollar;<?= $total_price ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div>
            <span class="text">Subtotal</span>
            <span class="price">&dollar; <?= ($count > 0) ? $count : 0 ?></span>
        </div>
        <div>
            <input type="submit" name="update" value="Update" class="btn btn-secondary btn-sm">
            <!-- <input type="submit" name="placeorder" value="Place Order" class="btn btn-success btn-sm"> -->
            <a href="placeorder.php?count=<?= $products_count ?>" class="btn btn-success btn-sm"> Place Order </a>
        </div>
    </form>
</div>

<?php
ob_end_flush();
include('footer.php');
?>