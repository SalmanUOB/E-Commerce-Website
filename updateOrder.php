<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Order Page</title>
    <!--css file -->
    <link rel="stylesheet" href="css/style.css">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>
    <div class="container">
        <section class="shoppingcart">
            <!-- using shoppingcart for CSS for Cart -->
            <h1 class="heading">Update Orders</h1>
            <table>
                <?php
                $select_orders = mysqli_query($conn, "SELECT orders.order_id, order_status, product_id, product_name, product_price, product_quantity FROM orders INNER JOIN order_items ON orders.order_id = order_items.order_id");
                if (mysqli_num_rows($select_orders) > 0) {
                    echo "<thead>
                        <th>Order ID</th>
                        <th>Order Status</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </thead>
                    <tbody>";

                    $current_order_id = null;
                    $item_count = 0;
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                        $order_id = $fetch_orders['order_id'];

                        if ($order_id !== $current_order_id) {
                            // Display order information for a new order
                            if ($current_order_id !== null) {
                                // Close the previous order's row
                                echo "</tr>";
                            }
                            $item_count = countItemsForOrder($select_orders, $order_id, $conn);
                            echo "<tr>
                                <td rowspan=\"{$item_count}\">{$order_id}</td>
                                <td rowspan=\"{$item_count}\">
                                    <form action='update_order_status.php' method='post'>
                                        <select name='order_status' onchange='this.form.submit()'>
                                            <option value='pending' " . ($fetch_orders['order_status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='order confirmed' " . ($fetch_orders['order_status'] == 'order confirmed' ? 'selected' : '') . ">Order Confirmed</option>
                                            <option value='delivering' " . ($fetch_orders['order_status'] == 'delivering' ? 'selected' : '') . ">Delivering</option>
                                            <option value='delivered' " . ($fetch_orders['order_status'] == 'delivered' ? 'selected' : '') . ">Delivered</option>
                                        </select>
                                        <input type='hidden' name='order_id' value='{$order_id}'>
                                    </form>
                                </td>
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
                    echo "</tbody>";
                } else {
                    echo "<div class='empty_text'>No orders found</div>";
                }
                ?>
            </table>
        </section>
    </div>
</body>
</html>

<?php
// Function to count the number of items for a given order
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