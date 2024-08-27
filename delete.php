<?php
include('conn.php');
$p_id = $_GET['remove'];
$delete = ("DELETE FROM `cart` WHERE id='$p_id'");
$result = mysqli_query($conn,$delete);
if($result){
    header('Location:cart.php');
}else{
    echo "error";
}

?>