<?php
require("includes/common.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = (int)$_GET['id'];
    $user_id = (int)$_SESSION['user_id'];

    $stmt = mysqli_prepare($con, "INSERT INTO users_products (user_id, item_id, status) VALUES (?, ?, 'Added To Cart')");
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $item_id);
    mysqli_stmt_execute($stmt);

    header('location: products.php');
    exit;
}
?>