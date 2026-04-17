<?php
session_start();
require "includes/common.php";

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | My Wishlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        body { background-color: #f8f9fa; font-family: 'Andika', sans-serif; }
        .wishlist-card { transition: 0.3s; border-radius: 10px; border: 1px solid #eee; }
        .wishlist-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .wishlist-img { height: 200px; object-fit: contain; padding: 10px; }
    </style>
</head>
<body style="margin-bottom: 100px;">
    <?php include 'includes/header_menu.php'; ?>

    <div class="container" style="margin-top: 120px; min-height: 60vh;">
        <h2 class="text-center mb-5" style="font-family: 'Delius Swash Caps'; color: #dc3545;">
            <i class="fa fa-heart"></i> My Wishlist
        </h2>
        
        <div class="row justify-content-center">
            <?php
            $query = "SELECT p.* FROM products p JOIN wishlist w ON p.id = w.product_id WHERE w.user_id = '$user_id'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    // SMART LOGIC FOR IMAGES (Same as index.php)
                    $p_id = $row['id'];
                    $img_src = "";
                    if($p_id >= 1 && $p_id <= 8) {
                        $img_src = "images/watch" . $p_id . ".jpg";
                    } else if($p_id >= 9 && $p_id <= 16) {
                        $img_src = "images/shirt" . ($p_id - 8) . ".jpg";
                    } else if($p_id >= 17 && $p_id <= 24) {
                        $img_src = "images/shoe" . ($p_id - 16) . ".jpg";
                    } else if($p_id >= 25 && $p_id <= 28) {
                        $img_src = "images/sp" . ($p_id - 24) . ".jpg";
                    } else {
                        $img_src = "images/default.jpg";
                    }
                    ?>
                    
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card wishlist-card h-100 bg-white p-2">
                            <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="card-img-top wishlist-img">
                            
                            <div class="card-body p-2 d-flex flex-column">
                                <h6 class="text-center text-truncate" title="<?php echo htmlspecialchars($row['name']); ?>"><?php echo htmlspecialchars($row['name']); ?></h6>
                                <p class="text-center text-success font-weight-bold mb-3" style="font-size: 1.2rem;">₹<?php echo $row['price']; ?></p>
                                
                                <div class="mt-auto">
                                    <a href="cart-add.php?id=<?php echo $row['id']; ?>" class="btn btn-warning text-white btn-sm btn-block mb-2" style="border-radius: 20px;">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </a>
                                    <a href="wishlist_script.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm btn-block" style="border-radius: 20px;">
                                        <i class="fa fa-trash"></i> Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-12 text-center p-5 bg-white shadow-sm' style='border-radius: 10px;'>
                        <i class='fa fa-heart-broken text-danger mb-3' style='font-size: 50px;'></i>
                        <h4 class='text-muted mb-3'>Your wishlist is completely empty!</h4>
                        <p class='text-muted mb-4'>Explore our collections and save your favorite items here.</p>
                        <a href='products.php' class='btn btn-danger btn-lg' style='border-radius: 25px;'><i class='fa fa-shopping-bag'></i> Continue Shopping</a>
                      </div>";
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>