<?php
session_start();
require "includes/common.php";

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Western-side | Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        .table td, .table th { vertical-align: middle; }
        .cart-img {
            width: 80px; height: 80px; object-fit: cover;
            border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<?php include 'includes/header_menu.php'; ?>

<div class="d-flex justify-content-center" style="margin-bottom: 100px;">
    <div class="col-md-8 my-5 table-responsive p-4 bg-white shadow-sm rounded">
        <h3 class="mb-4 font-weight-bold text-center">Your Shopping Cart</h3>
        <table class="table table-striped table-hover text-center">
        <?php
        $sum     = 0;
        $user_id = (int) $_SESSION['user_id'];

        // Query se 'Image' nikal diya hai, hum manually banayenge
        $stmt = mysqli_prepare($con,
            "SELECT p.price AS Price, p.id, p.name AS Name
             FROM users_products up
             JOIN products p ON up.item_id = p.id
             WHERE up.user_id = ?
               AND up.status = 'Added To Cart'"
        );

        if (!$stmt) { die("Query preparation failed: " . mysqli_error($con)); }

        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) >= 1):
        ?>
            <thead class="thead-dark">
                <tr>
                    <th>Item No.</th>
                    <th>Product Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)):
                $sum += $row['Price'];
                $item_id = (int)$row['id'];
                
                // --- THE MAGIC LOGIC ---
                // ID ke hisaab se sahi photo ka path banana
                $image_name = "product.jpg"; // Default
                
                if ($item_id >= 1 && $item_id <= 8) {
                    $image_name = "watch" . $item_id . ".jpg";
                } elseif ($item_id >= 9 && $item_id <= 16) {
                    $shirt_num = $item_id - 8;
                    $image_name = "shirt" . $shirt_num . ".jpg";
                } elseif ($item_id >= 17 && $item_id <= 24) {
                    $shoe_num = $item_id - 16;
                    $image_name = "shoe" . $shoe_num . ".jpg";
                } elseif ($item_id >= 25 && $item_id <= 28) {
                    $sp_num = $item_id - 24;
                    $image_name = "sp" . $sp_num . ".jpg";
                }
            ?>
                <tr>
                    <td>#<?php echo $item_id; ?></td>
                    <td>
                        <img src="images/<?php echo $image_name; ?>" alt="Product" class="cart-img">
                    </td>
                    <td class="font-weight-bold"><?php echo htmlspecialchars($row['Name']); ?></td>
                    <td class="text-success font-weight-bold">Rs <?php echo (int)$row['Price']; ?></td>
                    <td>
                        <a href="cart-remove.php?id=<?php echo $item_id; ?>" class="btn btn-sm btn-outline-danger">Remove <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?>
                <tr class="bg-light">
                    <td colspan="3" class="text-right h5"><strong>Total Amount:</strong></td>
                    <td class="h5 text-success"><strong>Rs <?php echo $sum; ?></strong></td>
                    <td>
                        <a href="checkout.php" class="btn btn-primary btn-block shadow-sm">Proceed to Checkout</a>
                    </td>
                </tr>
            </tbody>
        <?php else: ?>
            <tbody>
                <tr>
                    <td class="text-center p-5" colspan="5">
                        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" class="img-fluid mb-4 opacity-50" height="120" width="120" style="opacity: 0.5;"><br>
                        <div class="h4 text-muted">Your cart is empty.</div>
                        <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                        <a href="products.php" class="btn btn-warning text-white font-weight-bold px-4 py-2" style="border-radius: 25px;">Shop Now</a>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>
        <?php mysqli_stmt_close($stmt); ?>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    if (window.location.href.indexOf('#login') !== -1) { $('#login').modal('show'); }
});
</script>
<?php if (isset($_GET['error'])): ?>
<script>
$(document).ready(function(){ $('#signup').modal('show'); });
alert('<?php echo addslashes(htmlspecialchars($_GET['error'])); ?>');
</script>
<?php endif; ?>
<?php if (isset($_GET['errorl'])): ?>
<script>
$(document).ready(function(){ $('#login').modal('show'); });
alert('<?php echo addslashes(htmlspecialchars($_GET['errorl'])); ?>');
</script>
<?php endif; ?>
</body>
</html>