<?php
session_start();

if(!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "ecommerce");
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$success = "";
$error   = "";

// Handle form submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name     = trim($_POST['name']);
    $price    = trim($_POST['price']);
    $category = trim($_POST['category']);

    if(empty($name) || empty($price) || empty($category)){
        $error = "All fields are required.";
    } elseif(!is_numeric($price) || $price <= 0){
        $error = "Price must be a valid positive number.";
    } else {
        $name     = mysqli_real_escape_string($conn, $name);
        $price    = (int)$price;
        $category = mysqli_real_escape_string($conn, $category);

        $insert = "INSERT INTO products (name, price, category) VALUES ('$name', $price, '$category')";
        if(mysqli_query($conn, $insert)){
            $success = "Product <strong>" . htmlspecialchars($name) . "</strong> added successfully!";
        } else {
            $error = "DB Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | Add Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/v4-shims.min.css">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        body { font-family: 'Andika', sans-serif; background: #f8f9fa; }

        /* ── Sidebar ── */
        .sidebar {
            height: 100vh; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            position: fixed; width: 260px; top: 0; left: 0; z-index: 1030;
            transition: all 0.3s; overflow-y: auto;
        }
        .sidebar .logo {
            padding: 30px 20px; text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: white; font-family: 'Delius Swash Caps', cursive;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8) !important; padding: 15px 20px !important;
            border-radius: 0; margin: 2px 10px; transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2) !important;
            color: white !important; transform: translateX(10px);
        }

        /* ── Layout ── */
        .main-content { margin-left: 260px; padding: 30px; min-height: 100vh; }
        .sidebar.hide  { transform: translateX(-260px); }
        .main-content.full { margin-left: 0; }

        .mobile-toggle {
            position: fixed; top: 20px; left: 20px; z-index: 1040;
            background: rgba(30,60,114,0.9); border: none; color: white;
            width: 50px; height: 50px; border-radius: 50%; font-size: 20px;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Form Card ── */
        .form-card {
            background: white; border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 40px; max-width: 600px; margin: 0 auto;
        }
        .form-card h3 {
            color: #1e3c72; font-family: 'Delius Swash Caps', cursive;
            margin-bottom: 30px;
        }
        .form-control:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42,82,152,0.25);
        }
        .btn-submit {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border: none; color: white; padding: 12px 30px;
            border-radius: 8px; font-size: 16px; width: 100%;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30,60,114,0.4);
            color: white;
        }
        .btn-back {
            background: #6c757d; border: none; color: white;
            padding: 10px 20px; border-radius: 8px; transition: all 0.3s;
        }
        .btn-back:hover { background: #545b62; color: white; }

        /* Category option colors */
        .cat-tshirt { color: #ff6b6b; font-weight: bold; }
        .cat-watch  { color: #4ecdc4; font-weight: bold; }
        .cat-shoes  { color: #45b7d1; font-weight: bold; }
        .cat-other  { color: #adb5bd; font-weight: bold; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-260px); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .form-card { padding: 20px; }
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
            <a class="nav-link" href="orders.php">
                <i class="fa fa-shopping-cart mr-2"></i> Orders
            </a>
            <a class="nav-link text-danger" href="index.php?logout=1">
                <i class="fa fa-sign-out mr-2"></i> Logout
            </a>
        </nav>
    </div>

    <div class="main-content" id="mainContent">

        <div class="form-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="fa fa-plus-circle mr-2"></i> Add New Product</h3>
                <a href="index.php" class="btn btn-back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>

            <?php if($success): ?>
                <div class="alert alert-success">
                    <i class="fa fa-check-circle mr-2"></i> <?php echo $success; ?>
                    <a href="index.php" class="btn btn-sm btn-success ml-3">Go to Dashboard</a>
                    <a href="add_product.php" class="btn btn-sm btn-outline-success ml-1">Add Another</a>
                </div>
            <?php endif; ?>

            <?php if($error): ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle mr-2"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="add_product.php">

                <div class="form-group">
                    <label for="name"><i class="fa fa-tag mr-1"></i> Product Name</label>
                    <input
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder="e.g. Nike White Sneaker"
                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="price"><i class="fa fa-rupee mr-1"></i> Price (₹)</label>
                    <input
                        type="number"
                        class="form-control"
                        id="price"
                        name="price"
                        placeholder="e.g. 1999"
                        min="1"
                        value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category"><i class="fa fa-list mr-1"></i> Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="" disabled selected>-- Select Category --</option>
                        <option value="tshirt"  <?php echo (isset($_POST['category']) && $_POST['category']==='tshirt')  ? 'selected' : ''; ?>>
                            👕 T-Shirt
                        </option>
                        <option value="watch"   <?php echo (isset($_POST['category']) && $_POST['category']==='watch')   ? 'selected' : ''; ?>>
                            ⌚ Watch
                        </option>
                        <option value="shoes"   <?php echo (isset($_POST['category']) && $_POST['category']==='shoes')   ? 'selected' : ''; ?>>
                            👟 Shoes
                        </option>
                        <option value="other"   <?php echo (isset($_POST['category']) && $_POST['category']==='other')   ? 'selected' : ''; ?>>
                            📦 Other
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-submit mt-3">
                    <i class="fa fa-plus mr-2"></i> Add Product
                </button>

            </form>
        </div>

    </div><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script>
        document.getElementById("toggleBtn").addEventListener("click", function(){
            document.getElementById("sidebar").classList.toggle("hide");
            document.getElementById("mainContent").classList.toggle("full");
        });
    </script>

</body>
</html>