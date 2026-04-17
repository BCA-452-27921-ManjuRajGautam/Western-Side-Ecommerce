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

// Total confirmed orders
$total_orders_q = "SELECT COUNT(DISTINCT up.id) as total FROM users_products up WHERE up.status = 'Confirmed'";
$total_orders_r = mysqli_query($conn, $total_orders_q);
$total_orders   = ($total_orders_r) ? mysqli_fetch_assoc($total_orders_r)['total'] : 0;

// Total revenue
$revenue_q = "SELECT SUM(p.price) as total FROM users_products up
               JOIN products p ON up.item_id = p.id
               WHERE up.status = 'Confirmed'";
$revenue_r = mysqli_query($conn, $revenue_q);
$total_revenue = ($revenue_r) ? mysqli_fetch_assoc($revenue_r)['total'] : 0;

// Cart (pending) orders
$pending_q = "SELECT COUNT(*) as total FROM users_products WHERE status = 'Added To Cart'";
$pending_r = mysqli_query($conn, $pending_q);
$total_pending = ($pending_r) ? mysqli_fetch_assoc($pending_r)['total'] : 0;

// Total customers who ordered
$customers_q = "SELECT COUNT(DISTINCT user_id) as total FROM users_products WHERE status = 'Confirmed'";
$customers_r = mysqli_query($conn, $customers_q);
$total_customers = ($customers_r) ? mysqli_fetch_assoc($customers_r)['total'] : 0;

// --- ALL ORDERS (joined with user and product) ---
$orders_q = "SELECT 
                up.id         AS order_id,
                up.status     AS order_status,
                u.first_name,
                u.last_name,
                u.email_id,
                p.name        AS product_name,
                p.price,
                p.category
             FROM users_products up
             JOIN users    u ON up.user_id  = u.id
             JOIN products p ON up.item_id  = p.id
             ORDER BY up.id DESC";
$orders_r = mysqli_query($conn, $orders_q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | Orders Admin</title>
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
        .stat-sales    .stat-icon { background: linear-gradient(135deg, #f093fb, #f5576c); color: white; }
        .stat-revenue  .stat-icon { background: linear-gradient(135deg, #4ecdc4, #44a08d); color: white; }
        .stat-orders   .stat-icon { background: linear-gradient(135deg, #ff6b6b, #ff8e8e); color: white; }
        .stat-pending  .stat-icon { background: linear-gradient(135deg, #45b7d1, #96c93d); color: white; }
        .stat-number { font-size: 28px; font-weight: bold; color: #1e3c72; margin-bottom: 5px; }
        .stat-label  { color: #6c757d; font-size: 14px; margin-bottom: 8px; }
        .table-responsive { background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .table-header { padding: 25px; background: #f8f9fa; border-bottom: 1px solid #dee2e6; }
        .btn-admin { background: linear-gradient(135deg, #1e3c72, #2a5298); border: none; }
        .btn-admin:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(30,60,114,0.4); }
        .badge-confirmed { background: #d4edda; color: #155724; }
        .badge-cart      { background: #fff3cd; color: #856404; }
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
        <a class="nav-link" href="electronics.php">
            <i class="fa fa-headphones mr-2"></i> Electronics
        </a>
        <a class="nav-link active" href="orders.php">
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
                    <i class="fa fa-shopping-cart"></i> Orders Management
                </h1>
                <p class="mb-0 text-muted">Track and manage all customer orders</p>
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
            <div class="stat-card stat-orders">
                <div class="stat-icon"><i class="fa fa-shopping-cart"></i></div>
                <div class="stat-number"><?php echo $total_orders; ?></div>
                <div class="stat-label">Total Orders</div>
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
            <div class="stat-card stat-pending">
                <div class="stat-icon"><i class="fa fa-clock-o"></i></div>
                <div class="stat-number"><?php echo $total_pending; ?></div>
                <div class="stat-label">Pending (In Cart)</div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="stat-card stat-sales">
                <div class="stat-icon"><i class="fa fa-users"></i></div>
                <div class="stat-number"><?php echo $total_customers; ?></div>
                <div class="stat-label">Customers Ordered</div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="table-header d-flex justify-content-between align-items-center">
            <h4 style="color: #1e3c72; margin: 0;">
                <i class="fa fa-list mr-2"></i> All Orders
            </h4>
        </div>
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if($orders_r && mysqli_num_rows($orders_r) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($orders_r)): ?>
                <?php
                    // Status badge
                    if($row['order_status'] === 'Confirmed'){
                        $status_badge = 'badge-confirmed';
                        $status_icon  = 'fa-check-circle';
                    } else {
                        $status_badge = 'badge-cart';
                        $status_icon  = 'fa-clock-o';
                    }

                    // Category badge color
                    $cat = strtolower($row['category']);
                    if($cat === 'tshirt')     $cat_color = '#ff6b6b';
                    elseif($cat === 'watch')  $cat_color = '#4ecdc4';
                    elseif($cat === 'shoes')  $cat_color = '#45b7d1';
                    else                      $cat_color = '#adb5bd';
                ?>
                <tr>
                    <td><strong>#<?php echo $row['order_id']; ?></strong></td>
                    <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                    <td><small class="text-muted"><?php echo htmlspecialchars($row['email_id']); ?></small></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td>
                        <span class="badge p-1" style="background:<?php echo $cat_color; ?>; color:white;">
                            <?php echo ucfirst($cat); ?>
                        </span>
                    </td>
                    <td>₹<?php echo number_format($row['price']); ?></td>
                    <td>
                        <span class="badge <?php echo $status_badge; ?> px-3 py-2">
                            <i class="fa <?php echo $status_icon; ?> mr-1"></i>
                            <?php echo $row['order_status']; ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fa fa-shopping-cart fa-3x mb-3 d-block"></i>
                        No orders found yet.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
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