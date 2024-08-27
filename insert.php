<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form method="post" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-4 offset-md-4 mt-5 p-3" style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;">
            <h2 class="text-center">Product Form</h2>
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="pname" name="pname" required><br>
            <label for="name" class="form-label">Product Description</label>
            <textarea class="form-control" id="pdesc" name="pdesc"></textarea><br>
            <label for="age" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" required><br>
            <label for="age" class="form-label">Quantity</label>
            <input type="number" min="1" class="form-control" id="quantity" name="quantity" required><br>
            <label for="desig" class="form-label">Product Image</label>
            <input type="file" class="form-control" name="pimage" id="pimage" required><br>
            <input type="submit" class="btn btn-primary w-100" value="Submit" name="submit">
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        include('conn.php');
        $pname = $_POST['pname'];
        $pdesc = $_POST['pdesc'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $image = $_FILES['pimage'];
        $image_name = $_FILES['pimage']['name'];
        $image_path = $_FILES['pimage']['tmp_name'];
        $image_extension = $_FILES['pimage']['type'];
        $image_size = $_FILES['pimage']['size'];
        $folder = "images/";

        if ($image_size < 2000000) {
            if ($image_extension == 'image/jpeg' || $image_extension == 'image/jpg' || $image_extension == 'image/png') {
                $image_file = $folder . $image_name;
                move_uploaded_file($image_path, $image_file);
                $sql_insert = "INSERT INTO `products`( `title`, `description`, `price`, `quantity`, `image`, `date_added`) 
                VALUES ('$pname','$pdesc','$price','$quantity','$image_file',now())";
                $result = mysqli_query($conn, $sql_insert);
                if ($result) {
                    header('Location: home.php');
                }
            } else {
                echo "<script>alert('Wrong Extension!!')</script>";
            }
        } else {
            echo "<script>alert('File size is bigger than 2MB!!')</script>";
        }
    }


    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>