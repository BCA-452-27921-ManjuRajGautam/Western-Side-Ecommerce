<?php
session_start();

if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true){
    header("Location: login.php");
    exit();
}

// DB Connection
$conn = mysqli_connect("localhost", "root", "", "ecommerce");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// --- STATS ---

// Total electronics stock (category 'other' is used for electronics)
$stock_q = "SELECT SUM(stock) as total FROM products WHERE category='other' AND status='active'";
$stock_r  = mysqli_query($conn, $stock_q);
$total_stock = ($stock_r) ? mysqli_fetch_assoc($stock_r)['total'] : 0;

// Total electronics sold
$sold_q = "SELECT COUNT(*) as total FROM users_products up
            JOIN products p ON up.item_id = p.id
            WHERE p.category='other' AND up.status='Confirmed'";
$sold_r  = mysqli_query($conn, $sold_q);
$total_sold = ($sold_r) ? mysqli_fetch_assoc($sold_r)['total'] : 0;

// Total revenue from electronics
$rev_q = "SELECT SUM(p.price) as total FROM users_products up
           JOIN products p ON up.item_id = p.id
           WHERE p.category='other' AND up.status='Confirmed'";
$rev_r  = mysqli_query($conn, $rev_q);
$total_revenue = ($rev_r) ? mysqli_fetch_assoc($rev_r)['total'] : 0;

// Total electronics products count
$count_q = "SELECT COUNT(*) as total FROM products WHERE category='other'";
$count_r  = mysqli_query($conn, $count_q);
$total_products = ($count_r) ? mysqli_fetch_assoc($count_r)['total'] : 0;

// --- ALL ELECTRONICS PRODUCTS ---
$products_q = "SELECT * FROM products WHERE category='other' ORDER BY id DESC";
$products_r  = mysqli_query($conn, $products_q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | Electronics Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/v4-shims.min.css">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        body { font-family: 'Andika', sans-serif; background: #f8f9fa; }
        .sidebar {
            height: 100vh; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            position: fixed; width: 260px; top: 0; left: 0; z-index: 1030;
            transition: all 0.3s; overflow-y: auto;
        }
        .sidebar .logo {
            padding: 30px 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);
            color: white; font-family: 'Delius Swash Caps', cursive;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8) !important; padding: 15px 20px !important;
            border-radius: 0; margin: 2px 10px; transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2) !important; color: white !important; transform: translateX(10px);
        }
        .main-content { margin-left: 260px; padding: 20px; min-height: 100vh; }
        .page-header {
            background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px;
        }
        .stat-card {
            background: white; padding: 25px; border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08); transition: all 0.3s;
            text-align: center; height: 100%;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .stat-icon {
            width: 70px; height: 70px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px; font-size: 24px;
        }
        .stat-stock   .stat-icon { background: linear-gradient(135deg, #45b7d1, #96c93d); color: white; }
        .stat-sold    .stat-icon { background: linear-gradient(135deg, #ff6b6b, #ff8e8e); color: white; }
        .stat-revenue .stat-icon { background: linear-gradient(135deg, #f093fb, #f5576c); color: white; }
        .stat-total   .stat-icon { background: linear-gradient(135deg, #4ecdc4, #44a08d); color: white; }
        .stat-number { font-size: 28px; font-weight: bold; color: #1e3c72; margin-bottom: 5px; }
        .stat-label  { color: #6c757d; font-size: 14px; margin-bottom: 8px; }
        .table-responsive { background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .table-header { padding: 25px; background: #f8f9fa; border-bottom: 1px solid #dee2e6; }
        .btn-admin { background: linear-gradient(135deg, #1e3c72, #2a5298); border: none; }
        .btn-admin:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(30,60,114,0.4); }
        .sidebar.hide { transform: translateX(-260px); }
        .main-content.full { margin-left: 0; }
        .mobile-toggle {
            position: fixed; top: 20px; left: 20px; z-index: 1040;
            background: rgba(30,60,114,0.9); border: none; color: white;
            width: 50px; height: 50px; border-radius: 50%; font-size: 20px;
            display: flex; align-items: center; justify-content: center;
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-260px); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<button id="toggleBtn" class="mobile-toggle">
    <i class="fa fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="fa fa-tshirt fa-2x mb-2" style="color: #ffd700;"></i>
        <h3>Western-Side</h3>
        <small>Men's Fashion Admin</small>
    </div>
    <nav class="nav flex-column mt-2">
        <a class="nav-link" href="index.php">
            <i class="fa fa-tachometer mr-2"></i> Dashboard
        </a>
        <a class="nav-link" href="tshirts.php">
            <i class="fa fa-tshirt mr-2"></i> T-Shirts
        </a>
        <a class="nav-link" href="watches.php">
            <i class="fa fa-clock-o mr-2"></i> Watches
        </a>
        <a class="nav-link" href="shoes.php">
            <i class="fa fa-soccer-ball-o mr-2"></i> Shoes
        </a>
        <a class="nav-link active" href="electronics.php">
            <i class="fa fa-headphones mr-2"></i> Electronics
        </a>
        <a class="nav-link" href="orders.php">
            <i class="fa fa-shopping-cart mr-2"></i> Orders
        </a>
        <a class="nav-link text-danger" href="?logout=1">
            <i class="fa fa-sign-out mr-2"></i> Logout
        </a>
    </nav>
</div>

<div class="main-content" id="mainContent">

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 style="color: #1e3c72; font-family: 'Delius Swash Caps', cursive;">
                    <i class="fa fa-headphones"></i> Electronics Collection
                </h1>
                <p class="mb-0 text-muted">Manage all electronics and accessories inventory</p>
            </div>
            <div class="col-md-6 text-md-right">
                <span class="badge badge-primary p-2">
                    <i class="fa fa-circle text-success mr-1"></i> Online
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-stock">
                <div class="stat-icon"><i class="fa fa-archive"></i></div>
                <div class="stat-number"><?php echo $total_stock ? $total_stock : 0; ?></div>
                <div class="stat-label">Total Stock</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-sold">
                <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                <div class="stat-number"><?php echo $total_sold; ?></div>
                <div class="stat-label">Units Sold</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-revenue">
                <div class="stat-icon"><i class="fa fa-money"></i></div>
                <div class="stat-number">₹<?php echo number_format($total_revenue); ?></div>
                <div class="stat-label">Total Revenue</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-total">
                <div class="stat-icon"><i class="fa fa-headphones"></i></div>
                <div class="stat-number"><?php echo $total_products; ?></div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="table-header d-flex justify-content-between align-items-center">
            <h4 style="color: #1e3c72; margin: 0;">
                <i class="fa fa-list mr-2"></i> Electronics Inventory
            </h4>
            <a href="add_product.php" class="btn btn-admin text-white">
                <i class="fa fa-plus"></i> Add New Item
            </a>
        </div>
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Old Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if($products_r && mysqli_num_rows($products_r) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($products_r)): ?>
                <?php
                    if($row['stock'] == 0){
                        $stock_badge  = 'badge-danger';
                        $stock_label  = 'Out of Stock';
                        $status_badge = 'badge-danger';
                    } elseif($row['stock'] <= 10){
                        $stock_badge  = 'badge-warning';
                        $stock_label  = 'Low Stock';
                        $status_badge = 'badge-warning';
                    } else {
                        $stock_badge  = 'badge-success';
                        $stock_label  = 'In Stock';
                        $status_badge = 'badge-success';
                    }
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><strong><?php echo htmlspecialchars($row['name']); ?></strong></td>
                    <td><?php echo isset($row['brand']) ? htmlspecialchars($row['brand']) : '--'; ?></td>
                    <td>₹<?php echo number_format($row['price']); ?></td>
                    <td>
                        <?php if(isset($row['old_price']) && $row['old_price'] > 0): ?>
                            <span class="text-muted"><s>₹<?php echo number_format($row['old_price']); ?></s></span>
                        <?php else: ?>
                            --
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?php echo $stock_badge; ?>">
                            <?php echo isset($row['stock']) ? $row['stock'] : '--'; ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge <?php echo $status_badge; ?>">
                            <?php echo $stock_label; ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this product?')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="fa fa-headphones fa-3x mb-3 d-block"></i>
                        No Electronics found. <a href="add_product.php">Add one now</a>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    document.getElementById("toggleBtn").addEventListener("click", function(){
        document.getElementById("sidebar").classList.toggle("hide");
        document.getElementById("mainContent").classList.toggle("full");
    });
</script>

</body>
</html>