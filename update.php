<?php include 'connect.php';
//update logic
if(isset($_POST['update_product'])){
    $update_product_id=$_POST['update_product_id'];
    echo $update_product_id;
    $update_product_name=$_POST['update_product_name'];
    echo $update_product_name;
    $update_product_price=$_POST['update_product_price'];
    $update_product_quantity=$_POST['update_product_quantity'];
    $update_product_details=$_POST['update_product_details'];
 $update_product_image=$_FILES['update_product_image']['name'];
 $update_product_image_tmp_name=$FILES['update_product_image']['tmp_name'];
 $update_product_image_folder='images/'.$update_product_image;
 //update query
 $update_products=mysqli_query($conn,"Update `products` set name= '$update_product_name',price= '$update_product_price', quantity='$update_product_quantity',details= '$update_product_details',image='$update_product_image'where id=$update_product_id");
 if($update_products){
    move_uploaded_file($update_product_image_tmp_name,$update_product_image_folder);
   header('location:view_products.php');
 }
 else{
    $display_message= "there is some error in updating product";
 }
}?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatiable" content="IE-edge">
    <meta name="viewport" content="width=device-width,intial-scale=1.0">
    <title>Update Products Products-project333 </title>
    <!--css file -->
    <link rel="stylesheet" href="css/style.css">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include 'header.php';?>
      <!--message display-->
      <?php
    if(isset($display_message)){
        echo " <div class='display_message'>
        <span>$display_message</span>
        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
</div>";
    }
    ?>
    <section class="edit _container">
        <!-- php code-->
        <?php
        if(isset($_GET['edit'])){
            $edit_id=$_GET['edit'];
           // echo $edit_id;
           $edit_query=mysqli_query($conn,"Select * from`products`where id=$edit_id");
           if(mysqli_num_rows($edit_query)>0){
            while($fetch_data=mysqli_fetch_assoc($edit_query)){
                $row=$fetch_data['price'];
                echo $row;
            ?>
        <!--form-->
        <form action="" method="post" enctype="multipart/form-data" class="update_product product_container_box">
            <img src="images/<?php echo $fetch_data['image']?>" alt="">
            <input type="hidden" value="<?php echo $fetch_data['id']?>"name="update_product_id">
            <input type="text" class="input_fields" required value="<?php echo $fetch_data['name']?>"name="update_product_name">
            <input type="number" class="input_fields" required value="<?php echo $fetch_data['price']?>"name="update_product_price">
            <input type="number" class="input_fields" required value="<?php echo $fetch_data['quantity']?>"name="update_product_quantity">
            <input type="details" class="input_fields" required value="<?php echo $fetch_data['details']?>"name="update_product_details">
            <input type="file" class="input_fields" required accept="image/png ,image/jpg,image/jpeg"name="update_product_image">

            <div class="btns">
                <input type="submit" class="edit_btn" value="Update Product" name="update_product">
                <input type="reset" id="close-edit" value="Cancel"class= "cancel_btn">
</form>
            <?php
           }
        }
    }
        ?>

</section>
</body>
</html>