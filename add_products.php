<?php
include 'connect.php';

if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/' . $product_image;
    $product_category = $_POST['product_category'];
    $product_details = $_POST['product_details'];

    $insert_query = mysqli_query($conn, "INSERT INTO `products` (id, name, price, quantity, image, category, details) VALUES (null, '$product_name', '$product_price', '$product_quantity', '$product_image', '$product_category', '$product_details')") or die("Insert query failed");

    if ($insert_query) {
        move_uploaded_file($product_image_tmp_name, $product_image_folder);
        $display_message = "Product inserted successfully";
    } else {
        $display_message = "There is an error in inserting the product";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .category {
            margin-bottom: 20px;
            width: 100%;
        }

        /* Category dropdown */
        .category select {
            padding: 10px;
            font-size: 16px;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Include header -->
    <?php include('header.php') ?>

    <!-- Form section -->
    <div class="container">
        <!-- Message display -->
        <?php
        if (isset($display_message)) {
            echo "<div class='display_message'>
                <span>$display_message</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
            </div>";
        }
        ?>

        <section>
            <h3 class="heading">Add Products</h3>
            <form action="" class="add_product" method="post" enctype="multipart/form-data">
                <input type="text" name="product_name" placeholder="Enter product name" class="input_fields" required>
                <input type="number" name="product_price" min="0" placeholder="Enter product Price" class="input_fields" required>
                <input type="number" name="product_quantity" min="1" placeholder="Enter product Quantity" class="input_fields" required>
                <input type="file" name="product_image" class="input_fields" required accept="image/png,image/jpg,image/jpeg">
                <h1 style="color:white;">Select category:</h1><br>
                <div class="category">
                    <select name="product_category" required>
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Dairy">Dairy</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Sweets">Sweets</option>
                        <option value="Breads">Breads</option>
                        <option value="Meats">Meats</option>
                    </select>
                </div>
                <textarea name="product_details" placeholder="Enter product details" class="input_fields"></textarea>
                <input type="submit" name="add_product" class="submit_btn" value="Add Product">
            </form>
        </section>
    </div>
    <!-- JS file -->
    <script src="js/script.js"></script>
</body>
</html>
