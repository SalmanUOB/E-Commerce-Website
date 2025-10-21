<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "si", $order_status, $order_id);
        if(mysqli_stmt_execute($stmt)){
            header("location: updateOrder.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
