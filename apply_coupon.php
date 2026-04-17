<?php
session_start();
require "includes/common.php";

if(isset($_POST['coupon_code']) && isset($_POST['cart_total'])) {
    $code = mysqli_real_escape_string($con, strtoupper($_POST['coupon_code']));
    $total = (float)$_POST['cart_total'];

    // Check if coupon exists, is active, and not expired
    $query = "SELECT * FROM coupons WHERE code = '$code' AND status = 'active' AND expires_at >= CURDATE()";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Minimum order check
        if($total < $row['min_order']) {
            echo json_encode(['status' => 'error', 'message' => "Minimum order of ₹".$row['min_order']." required."]);
            exit;
        }

        // Maximum uses check
        if($row['used_count'] >= $row['max_uses']) {
            echo json_encode(['status' => 'error', 'message' => "This coupon usage limit has been reached."]);
            exit;
        }

        // Calculate discount
        $discount = 0;
        if($row['discount_type'] == 'percent') {
            $discount = ($total * $row['discount_value']) / 100;
        } else {
            $discount = $row['discount_value']; // Flat discount
        }

        $new_total = $total - $discount;

        echo json_encode([
            'status' => 'success', 
            'discount' => round($discount), 
            'new_total' => round($new_total), 
            'message' => "Yay! Coupon applied successfully."
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Invalid or expired coupon code!"]);
    }
}
?>