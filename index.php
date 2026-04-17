<?php
session_start();
// Database connection zaroori hai wishlist fetch karne ke liye
require_once "includes/common.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Western-Side | Online Shopping Site for Men</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        .wishlist-card { transition: 0.3s; border-radius: 10px; border: 1px solid #eee; }
        .wishlist-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .wishlist-img { height: 200px; object-fit: contain; padding: 10px; }
    </style>
</head>
<body style="margin-bottom:200px; background-color: #f8f9fa;">
    
    <?php
    include 'includes/header_menu.php';
    include 'includes/check-if-added.php';
    ?>
    <div id="content">
        <div id="bg" class=" ">
            <div class="container" style="padding-top:150px">
                <div class="mx-auto p-5 text-white" id="banner_content" style="border-radius: 0.5rem;" >
                    <h1>We sell Happiness :)</h1>
                    <p>Flat 40% OFF on premium brands </p>
                    <a href="products.php" class="btn btn-warning btn-lg text-white">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center pt-5 h3" style="font-family: 'Delius Swash Caps'; color: #1e3c72;">
        * Be fashionable Men *
    </div>

    <div class="container pt-3">
        <div class="row text-center ">
            <div class="col-6 col-md-3 py-3">
                <a href="products.php#watch" style="text-decoration: none; color: inherit;"> 
                    <img src="images/watch.jpg" class="img-fluid shadow-sm" alt="Watches" style="border-radius:0.5rem">
                    <div class="h5 pt-3 font-weight-bolder">Watches</div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3 " >
                <a href="products.php#shirt" style="text-decoration: none; color: inherit;">
                    <img src="images/clothing.jpg" class="img-fluid shadow-sm" alt="Clothing" style="border-radius:0.5rem" >
                    <div class="h5 pt-3 font-weight-bolder">Clothing</div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3">
                <a href="products.php#shoes" style="text-decoration: none; color: inherit;">
                    <img src="images/shoes.jpg" class="img-fluid shadow-sm" alt="Shoes" style="border-radius:0.5rem">
                    <div class="h5 pt-3 font-weight-bolder">Shoes</div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3">
                <a href="products.php#headphones" style="text-decoration: none; color: inherit;">
                    <img src="images/headphones.jpg" class="img-fluid shadow-sm" alt="Headphones" style="border-radius:0.5rem">
                    <div class="h5 pt-3 font-weight-bolder">Headphones</div>
                </a>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user_id'])) { ?>
    <div class="text-center pt-5 mt-4 h3" style="font-family: 'Delius Swash Caps'; color: #dc3545;">
        <i class="fa fa-heart"></i> My Wishlist
    </div>
    
    <div class="container pt-3 mb-5">
        <div class="row justify-content-center">
            <?php
            $user_id = $_SESSION['user_id'];
            $wishlist_query = "SELECT p.* FROM products p JOIN wishlist w ON p.id = w.product_id WHERE w.user_id = '$user_id'";
            $wishlist_result = mysqli_query($con, $wishlist_query);

            if (mysqli_num_rows($wishlist_result) > 0) {
                while ($row = mysqli_fetch_assoc($wishlist_result)) {
                    
                    // SMART LOGIC: Product ID se Image path nikalna
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
                        $img_src = "images/default.jpg"; // Agar koi naya item ho
                    }
                    ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card wishlist-card h-100 bg-white p-2">
                            <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="card-img-top wishlist-img">
                            
                            <div class="card-body p-2 d-flex flex-column">
                                <h6 class="text-center text-truncate" title="<?php echo htmlspecialchars($row['name']); ?>"><?php echo htmlspecialchars($row['name']); ?></h6>
                                <p class="text-center text-success font-weight-bold mb-3">₹<?php echo $row['price']; ?></p>
                                
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
                echo "<div class='col-12 text-center p-4 bg-white shadow-sm' style='border-radius: 10px;'>
                        <h5 class='text-muted mb-3'>Your wishlist is feeling lonely!</h5>
                        <a href='products.php' class='btn btn-danger' style='border-radius: 25px;'><i class='fa fa-heart'></i> Add Some Favorites</a>
                      </div>";
            }
            ?>
        </div>
    </div>
    <?php } ?>
    <?php include 'includes/footer.php'?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
$(document).ready(function() {
    if(window.location.href.indexOf('#login') != -1) {
      $('#login').modal('show');
    }
});
</script>

<?php if (isset($_GET['error'])) {
    $z = $_GET['error'];
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#signup').modal('show');
        });
    </script>";
    echo "<script type='text/javascript'>alert('" . htmlspecialchars($z) . "')</script>";
}?>
    
<?php if (isset($_GET['errorl'])) {
    $z = $_GET['errorl'];
    echo "<script type='text/javascript'>
        $(document).ready(function(){
            $('#login').modal('show');
        });
    </script>";
    echo "<script type='text/javascript'>alert('" . htmlspecialchars($z) . "')</script>";
}?>

</body>
</html>