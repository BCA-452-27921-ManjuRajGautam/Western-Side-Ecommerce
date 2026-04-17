<?php
session_start();
require "includes/common.php";

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = mysqli_real_escape_string($con, $_GET['id']);

$check_query = "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
$check_result = mysqli_query($con, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    $delete_query = "DELETE FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
    mysqli_query($con, $delete_query);
} else {
    $insert_query = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
    mysqli_query($con, $insert_query);
}

header('location: ' . $_SERVER['HTTP_REFERER']);
?>