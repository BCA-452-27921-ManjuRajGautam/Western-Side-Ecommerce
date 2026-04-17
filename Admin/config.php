<?php
session_start();

// Check if admin is logged in
if(!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'western_side');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

// Logout functionality
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!-- <?php
// config.php
$host = 'localhost';
$dbname = 'ecommerce';
$username = 'root';  // Change if needed
$password = '';      // Change if neededs

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
 -->
