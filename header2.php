    <!-- header-->
    <header class="header">
        <div class="header_body">
            <a href="shop_products.php" class ="logo">Super Market</a>
            <?php 
        session_start();
       if(isset($_SESSION['user'])){
        $user=$_SESSION['user'];
        $query=mysqli_query($conn, "SELECT * FROM `users` WHERE users.user='$user'");
        while($row=mysqli_fetch_array($query)){
            echo "<h1 style='text-align: center; color:white;'>Hello ".$row['user']."</h1>";
        
        }
       }
       ?>
            <nav class="navbar">
                <a href="shop_products.php">Shop it</a>
                <a href="orders.php">View Orders</a>
                <a href="logout.php">Logout</a>
                </nav>
                <div id="menu-btn" class="small">
                <a href="shop_products.php"><i class="fa-solid fa-shop"></i>
                <a href="orders.php"><i class="fa-solid fa-receipt"></i>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <style>
                    .small a{
                        color:white;
                        transition: 0.2s linear;
                        display: inline-block;
                        margin-right: 20px; 
                    }
                    #menu-btn a:last-child {
                        margin-right: 0
                    }

                </style>
<!-- select query -->
<?php 
$select_product=mysqli_query($conn, "Select * from cart") or die('Query Failed.');
$row_count=mysqli_num_rows($select_product);

?>
<!--shopping cart icon-->
<a href="cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i>
    <span><sup>
        <?php echo $row_count ?>  <!-- show item number in cart -->
    </sup></span></a>

</div>
</header>