<?php 
include 'connect.php';

// Search functionality
if(isset($_POST['search'])) {
    $search_query = $_POST['search_query'];
    $select_products = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search_query%'");
} 

elseif(isset($_POST['search_cate'])) {
    $search = $_POST['cate'];
    $select_products = mysqli_query($conn, "SELECT * FROM products WHERE category LIKE '%$search%'");
} 
else {
    $select_products = mysqli_query($conn, "SELECT * FROM products");
}

$display_message = [];

if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    // Select cart data based on condition
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$product_name'");
    if(mysqli_num_rows($select_cart) > 0) {
       $display_message[] = "Product already added to cart";
    }
    else {
        // Insert cart data into the cart table
        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (name, price, image, quantity) VALUES ('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $display_message[] = "Product added to cart";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE-edge">
    <meta name="viewport" content="width=device-width,intial-scale=1.0">
    <title>Shop Products - Project333</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    /* Category container */
    .search-container{
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;

    }
    .category {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }

    /* Category dropdown */
    .category select {
      padding: 10px;
      font-size: 16px;
    }

    /* Search button */
    .category button {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }

    /* Search button icon */
    .category button i {
      margin-right: 5px;
    }

    /* On hover styles */
    .category button:hover {
      background-color: #45a049;
    }

    .search-container button {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }

    /* Search button icon */
    .search-container button i {
      margin-right: 5px;
    }

    /* On hover styles */
    .search-container button:hover {
      background-color: #45a049;
    }
    .search-container input{
        width: 400px;
        height: 40px;
    }
    @media (max-width: 768px) {
    .search-container input{
        width: 300px;
        height: 40px;
    }
    }

    

  </style>
</head>
<body>
    <!-- Header -->
    <?php include 'header2.php'?>

    <div class="container"> 
        <?php
        if(isset($display_message)){
            foreach($display_message as $message){
                echo "<div class='display_message'>
                        <span>$message</span>
                        <i class='fas fa-times' onClick='this.parentElement.style.display=`none`';></i>
                      </div>";
            }
        }
        ?>
        <section class="products">
            <h1 class="heading">Let's Shop</h1>
            <div class="search-container">
                <form method="post" action="">
                    <input type="text" name="search_query" placeholder="Search products...">
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="category">
            <form method="post" action="">
            <select name="cate">
            <option value="">All Categories</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
            <option value="Dairy">Dairy</option>
            <option value="Drinks">Drinks</option>
            <option value="Sweets">Sweets</option>
            <option value="Breads">Breads</option>
            <option value="Meats">Meats</option>
            </select>
            <button type="submit" name="search_cate"><i class="fas fa-search"></i></button>
    </form>
    </div>
            <div class="product_container">
            <?php
    if(mysqli_num_rows($select_products) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_products)){
?>
        <form method="post" action="">
            <div class="edit_form">
                <img src="images/<?php echo $fetch_product['image'] ?>" alt="">
                <h3><?php echo $fetch_product['name'] ?></h3>
                <div class="price">Price: <?php echo $fetch_product['price'] ?> BD</div>
                <h4 style='display:none; color: black; font-size: 18px; font-family: Times New Roman, sans-serif; 
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); margin: 10px; border-radius:5px; padding: 10px;'
                id="details_<?php echo $fetch_product['id'] ?>">
                    <?php echo $fetch_product['details'] ?>
                </h4>
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'] ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'] ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image'] ?>">
                <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
                </br>
                <input type="button" class="submit_btn cart_btn" value="Details" name="details" onclick="toggleDetails('<?php echo $fetch_product['id'] ?>')">
            </div>
        </form>
<?php
        }
    }
    else {
        echo "<div class='empty_text'>No Products Available</div>";
    }
?>

<script>
    function toggleDetails(productId) {
        var detailsElement = document.getElementById('details_' + productId);
        if (detailsElement.style.display === 'none') {
            detailsElement.style.display = 'block';
        } else {
            detailsElement.style.display = 'none';
        }
    }
</script>

            </div>
        </section>
    </div>
</body>
</html>