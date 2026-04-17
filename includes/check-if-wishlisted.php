<?php
function check_if_wishlisted($item_id) {
    // Database connection
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM wishlist WHERE product_id='$item_id' AND user_id='$user_id'";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) >= 1) {
            return 1; // Product wishlist me hai
        }
    }
    return 0; // Product wishlist me nahi hai
}
?>