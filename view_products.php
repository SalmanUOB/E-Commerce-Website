<!--include php logic--connecting to database-->
<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE-edge">
    <meta name="viewport" content="width=device-width,intial-scale=1.0">
    <title>View Products - Project333</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .search-container{
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;

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
</style>
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'?>
    <!-- Container -->
    <div class="container">
        <section class="display_product">
            <!-- Search form -->
            <div class="search-container">
                <form method="post" action="">
                    <input type="text" name="search_query" placeholder="Search products...">
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <!-- PHP code -->
            <?php
            // Search functionality
            if(isset($_POST['search'])) {
                $search_query = $_POST['search_query'];
                $display_product = mysqli_query($conn, "SELECT * FROM products WHERE name LIKE '%$search_query%'");
            } else {
                $display_product = mysqli_query($conn, "SELECT * FROM products");
            }

            $num = 1;

            if(mysqli_num_rows($display_product) > 0) {
                echo "<table>
                        <thead>
                            <th>No.</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Product Details</th>
                            <th>Action</th>
                        </thead>
                        <tbody>";

                // Logic to fetch data
                while($row = mysqli_fetch_assoc($display_product)) {
                    echo "<tr>
                            <td>$num</td>
                            <td><img src='images/$row[image]' alt='$row[name]'></td>
                            <td>$row[name]</td>
                            <td>$row[price]</td>
                            <td>$row[quantity]</td>
                            <td>$row[details]</td>
                            <td>
                                <a href='delete.php?delete=$row[id]' class='delete_product_btn' onclick='return confirm(`Are you sure you want to delete this product?`);'><i class='fas fa-trash'></i></a>
                                <a href='update.php?edit=$row[id]' class='update_product_btn'><i class='fas fa-edit'></i></a>
                            </td>
                          </tr>";
                    $num++;
                }

                echo "</tbody>
                      </table>";
            } else {
                echo "<div class='empty_text'>No Products Available</div>";
            }
            ?>
        </section>
    </div>
</body>
</html>