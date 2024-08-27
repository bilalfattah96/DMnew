<?php
// Start output buffering to prevent any output before header() call
ob_start();
$title = "Product";
include('navbar.php');
if (!isset($_COOKIE['user'])) {
    header('Location: login.php');
    exit; // Stop script execution after redirect
}
include('conn.php');

$product_id = $_GET['id'];

$select = "SELECT * FROM `products` WHERE id = '$product_id'";
$result = mysqli_query($conn, $select);
$product = mysqli_fetch_array($result);
?>

<div class="container my-5">
    <div class="row align-items-center" style="height:65vh;">
        <div class="col-md-6">
            <img src="<?= $product['image'] ?>" class="w-100" height="400" alt="<?= $product['title'] ?>">
        </div>
        <div class="col-md-6">
            <div>
                <h1 class="name"><?= $product['title'] ?></h1>
                <span class="fs-3 text-secondary">
                    &dollar;<?= $product['price'] ?>
                </span><br><br>
                <form action="" method="post">
                    <input type="number" class="form-control" name="quantity" value="1" min="1" placeholder="Quantity" required><br>
                    <input type="text" class="form-control" name="product_id" value="<?= $product[0] ?>" hidden><br>
                    <input type="text" class="form-control" name="product_title" value="<?= $product['title'] ?>" hidden>
                    <input type="text" class="form-control" name="product_price" value="<?= $product['price'] ?>" hidden>
                    <input type="text" class="form-control" name="product_img" value="<?= $product['image'] ?>" hidden>
                    <input type="submit" value="Add to Cart" class="btn btn-primary w-100" name="submit">
                </form>
                <div class="description">
                    <?= $product['description'] ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');

if (isset($_POST['submit'])) {
    $id = $_POST['product_id'];
    $title = $_POST['product_title'];
    $price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['product_img'];
    $u_id = $_SESSION['username'];
    echo $u_id;

    $insert = "INSERT INTO `cart`( `u_id`,`p_title`, `p_quantity`, `p_price`, `p_image`) VALUES ('$u_id','$title','$quantity','$price','$image')";
    $result = mysqli_query($conn, $insert);
    echo $result;
    if ($result) {
        header('Location: cart.php');
        exit; // Stop script execution after redirect
    } else {
        echo "error";
    }
}

// Flush output buffer
ob_end_flush();
?>
