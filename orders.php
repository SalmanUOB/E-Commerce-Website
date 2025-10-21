<?php
include 'connect.php';

$select_orders = mysqli_query($conn, "
    SELECT
        orders.order_id,
        orders.order_status,
        order_items.product_id,
        order_items.product_name,
        order_items.product_price,
        order_items.product_quantity
    FROM orders
    INNER JOIN order_items ON orders.order_id = order_items.order_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
    <!--css file -->
    <link rel="stylesheet" href="css/style.css">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Include Header -->
    <?php include 'header2.php'; ?>
    <div class="container">
        <section class="shoppingcart">
            <!-- using shoppingcart for CSS for Cart -->
            <h1 class="heading">Orders</h1>
            <?php
            if (mysqli_num_rows($select_orders) > 0) {
                echo "<table>
                    <thead>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </thead>
                    <tbody>";

                $current_order_id = null;
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    $order_id = $fetch_orders['order_id'];

                    if ($order_id !== $current_order_id) {
                        // Display order information for a new order
                        if ($current_order_id !== null) {
                            // Close the previous order's row
                            echo "</tr>";
                        }
                        echo "<tr>
                            <td rowspan=\"" . countItemsForOrder($select_orders, $order_id, $conn) . "\">{$order_id}</td>
                            <td rowspan=\"" . countItemsForOrder($select_orders, $order_id, $conn) . "\">{$fetch_orders['order_status']}</td>
                            <td>{$fetch_orders['product_id']}</td>
                            <td>{$fetch_orders['product_name']}</td>
                            <td>BD {$fetch_orders['product_price']}</td>
                            <td>{$fetch_orders['product_quantity']}</td>
                        ";
                        $current_order_id = $order_id;
                    } else {
                        // Display additional items for the same order
                        echo "<tr>
                            <td>{$fetch_orders['product_id']}</td>
                            <td>{$fetch_orders['product_name']}</td>
                            <td>BD {$fetch_orders['product_price']}</td>
                            <td>{$fetch_orders['product_quantity']}</td>
                        </tr>";
                    }
                }

                echo "</tbody>
                </table>";
            } else {
                echo "<div class='empty_text'>No orders found</div>";
            }
            ?>
        </section>
    </div>
</body>
</html>

<?php
// count the number of items for a given order
function countItemsForOrder($result, $order_id, $conn)
{
    $count = 0;
    $select_items = mysqli_query($conn, "
        SELECT COUNT(*) as item_count
        FROM order_items
        WHERE order_id = '$order_id'
    ");
    $item_data = mysqli_fetch_assoc($select_items);
    $count = $item_data['item_count'];
    return $count;
}
?>