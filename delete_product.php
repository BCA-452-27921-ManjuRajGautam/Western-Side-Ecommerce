<?php
session_start();
require "includes/db.php";   // only DB connection

// Admin auth guard
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

$id   = (int) $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");

if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: admin.php");
exit;