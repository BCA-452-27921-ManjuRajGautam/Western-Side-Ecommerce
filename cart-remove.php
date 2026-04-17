<?php
session_start();
require "includes/common.php";   // fixed: was db.php

if (!isset($_SESSION['user_id'])) {   // fixed: was $_SESSION['email']
    header('location: index.php');
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = (int) $_GET['id'];
    $user_id = (int) $_SESSION['user_id'];

    $stmt = mysqli_prepare($con,   // fixed: was $conn
        "DELETE FROM users_products WHERE item_id = ? AND user_id = ? AND status = 'Added To Cart'"
    );

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($con));  // fixed: was $conn
    }

    mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header("location: cart.php");
exit;
?>