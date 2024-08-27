<?php
session_start();
include('conn.php');
$products_count = $_GET['count'];
if ($products_count > 0) {
    $u_id = $_SESSION['username'];
    $delete = ("DELETE FROM cart WHERE u_id='$u_id'");
    $result = mysqli_query($conn, $delete);

    if ($result) {
        echo "<div class='mt-3 container alert alert-success alert-dismissible fade show' role='alert'>
                Your order has been placed successfully!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        header('Location:cart.php');
    } else {
        echo "error";
    }
}
?>
