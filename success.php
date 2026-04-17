<?php
session_start();
require "includes/common.php";

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get Data from URL safely
$address = isset($_GET['address']) ? mysqli_real_escape_string($con, $_GET['address']) : 'Not Provided';
$city    = isset($_GET['city']) ? mysqli_real_escape_string($con, $_GET['city']) : '';
$state   = isset($_GET['state']) ? mysqli_real_escape_string($con, $_GET['state']) : ''; 
$pincode = isset($_GET['pincode']) ? mysqli_real_escape_string($con, $_GET['pincode']) : '';
$payment_mode = isset($_GET['payment_mode']) ? mysqli_real_escape_string($con, $_GET['payment_mode']) : 'COD';

// Get Coupon and Discount
$coupon_code = isset($_GET['coupon']) ? mysqli_real_escape_string($con, $_GET['coupon']) : 'NULL';
$discount_val = isset($_GET['discount']) ? (int)$_GET['discount'] : 0;

if ($payment_mode === 'Razorpay') {
    $payment_id = isset($_GET['payment_id']) ? mysqli_real_escape_string($con, $_GET['payment_id']) : 'Unknown';
    $payment_status = 'Paid';
} else {
    $payment_id = 'CASH_ON_DELIVERY';
    $payment_status = 'Pending';
}

$sum_query = "SELECT SUM(p.price) AS total FROM users_products up JOIN products p ON up.item_id = p.id WHERE up.user_id = '$user_id' AND up.status = 'Added To Cart'";
$sum_result = mysqli_query($con, $sum_query);
$sum_row = mysqli_fetch_assoc($sum_result);
$total_amount = $sum_row['total'];

if ($total_amount > 0) {
    // Calculate final paid amount (Original - Discount)
    $final_paid_amount = $total_amount - $discount_val;

    // Database mein insert karte waqt NULL ko theek se bhejna
    $coupon_sql = ($coupon_code !== 'NULL') ? "'$coupon_code'" : "NULL";

    // 1. Insert into orders table (Original Query - No extra columns to cause errors)
    $order_query = "INSERT INTO orders (user_id, total_amount, status, payment_method, payment_status, address, city, state, pincode, coupon_code, discount) 
                    VALUES ('$user_id', '$final_paid_amount', 'Pending', '$payment_mode', '$payment_status', '$address', '$city', '$state', '$pincode', $coupon_sql, '$discount_val')";
    mysqli_query($con, $order_query);
    
    $order_id = mysqli_insert_id($con);
    
    // 2. Fetch cart items and insert them into order_items table
    $cart_query = "SELECT up.item_id, p.price FROM users_products up JOIN products p ON up.item_id = p.id WHERE up.user_id = '$user_id' AND up.status = 'Added To Cart'";
    $cart_result = mysqli_query($con, $cart_query);
    
    while ($cart_item = mysqli_fetch_assoc($cart_result)) {
        $product_id = $cart_item['item_id'];
        $price = $cart_item['price'];
        $quantity = 1; 
        
        $item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
        mysqli_query($con, $item_query);
    }
    
    // 3. Mark cart items as Confirmed AND update payment_id
    $update_cart = "UPDATE users_products SET status='Confirmed', payment_id='$payment_id' WHERE user_id='$user_id' AND status='Added To Cart'";
    mysqli_query($con, $update_cart);

    // 4. Update the Coupon Used Count (agar coupon apply hua hai)
    if ($coupon_code !== 'NULL') {
        mysqli_query($con, "UPDATE coupons SET used_count = used_count + 1 WHERE code = '$coupon_code'");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Andika', sans-serif; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <?php include 'includes/header_menu.php'; ?>

    <div class="container" style="margin-top: 120px; margin-bottom: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center bg-white p-5 shadow-sm rounded">
                <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                <h2 class="mt-4 text-success font-weight-bold">Order Confirmed!</h2>
                <p class="text-muted mt-3">Thank you for shopping at Western-Side.</p>
                
                <div class="alert alert-info mt-4 text-left shadow-sm">
                    <p class="mb-2"><strong><i class="fas fa-wallet mr-2"></i> Payment Method:</strong> <?php echo ($payment_mode === 'Razorpay') ? 'Online (Razorpay)' : 'Cash on Delivery (COD)'; ?></p>
                    <p class="mb-2"><strong><i class="fas fa-hashtag mr-2"></i> Transaction ID:</strong> <?php echo htmlspecialchars($payment_id); ?></p>
                    
                    <?php if($discount_val > 0) { ?>
                        <p class="mb-2 text-success font-weight-bold"><strong><i class="fas fa-tags mr-2"></i> Discount Applied:</strong> ₹<?php echo $discount_val; ?> (<?php echo htmlspecialchars($coupon_code); ?>)</p>
                    <?php } ?>

                    <p class="mb-0"><strong><i class="fas fa-map-marker-alt mr-2"></i> Delivering to:</strong> <?php echo htmlspecialchars($city) . ", " . htmlspecialchars($state) . " - " . htmlspecialchars($pincode); ?></p>
                </div>
                
                <hr>
                <p class="text-muted">Your order will be delivered to your address within 3-5 business days.</p>
                <a href="products.php" class="btn btn-primary mt-3 px-4 py-2" style="border-radius: 25px; background-color: #1e3c72; border:none;">Continue Shopping</a>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>