<?php include 'connect.php'; 


// Create new order
mysqli_query($conn, "INSERT INTO orders (order_status) VALUES ('Pending')");

// Get id of new order
$order_id = mysqli_insert_id($conn);

// Move all items from the cart to the order_items table
mysqli_query($conn, "INSERT INTO order_items (order_id, product_name, product_price, product_quantity)
                     SELECT $order_id, name, price, quantity FROM cart");

// Clear the cart
mysqli_query($conn, "DELETE FROM cart");

// Select the items for the new order
$select_order_items = mysqli_query($conn, "SELECT * FROM order_items WHERE order_id = $order_id");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Page</title>

    <!--css file -->
    <link rel="stylesheet" href="css/style.css">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!-- Include Header -->
    <?php include 'header2.php' ;?>
    <div class="container">
        <section class="shoppingcart">
        <div class="order_placed">
        
        
    </div>
            <h1 class="heading">Order Receipt</h1>
            <table>
                <?php
                $select_cart_products=mysqli_query($conn, "select * from cart");
            
                $num=1;
                $grand_total=0;
                if(mysqli_num_rows($select_order_items)>0){
                    echo "  
                    <h2 style='color:green;  text-align:center'>Order Placed Successfully!</h2>
                    <thead>
                    <th>Sl No.</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    </thead>
                    <tbody>
                        ";
                
                    while($fetch_order_items=mysqli_fetch_assoc($select_order_items)){
                        ?>
                
                    <tr>
                    <td><?php echo $num?></td>
                    <td><?php echo $fetch_order_items['product_name'] ?></td>
                    <td>BD  <?php echo $fetch_order_items['product_price'] ?></td>
                    <td><?php echo $fetch_order_items['product_quantity'] ?></td>
                    <td>BD <?php echo $subtotal= ($fetch_order_items['product_price'] * $fetch_order_items['product_quantity']) ?></td>
                    </tr>
                <?php
                    $grand_total+= ($fetch_order_items['product_price'] * $fetch_order_items['product_quantity']);
                    $num++; 
                    }
                }
                else{
                    echo "<div class='empty_text'>No items in the order</div>";
                }
                

                ?>
        
                
                    
                </tbody>
            </table>

            <!-- php -->
            <!--Bottom area-->
            <?php 
            
            if($grand_total>0){
                echo "<div class='table_bottom'>
                
                <h3 class='bottom_btn'>Grand Total: <span>BD  $grand_total </span></h3>
                <a href='orders.php' class='bottom_btn'>View order</a>
            </div>";
            
            
            
            ?>


            <?php
            } 
            else {
                echo "";
            }
            ?>
        </section>
    </div>
    
</body>
</html>
