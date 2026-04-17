<?php
require ("includes/common.php");
session_start();

$email = mysqli_real_escape_string($con, $_POST['lemail']);
$password = md5(mysqli_real_escape_string($con, $_POST['lpassword']));

// Query mein first_name, last_name aur phone bhi fetch kar rahe hain
$query = "SELECT id, email_id, first_name, last_name, phone FROM users WHERE email_id='$email' AND password='$password'";
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);

if ($num == 0) {
    $m = "Please enter correct E-mail id and Password";
    header('location: index.php?errorl=' . $m);
} else {
    $row = mysqli_fetch_array($result);
    $_SESSION['email'] = $row['email_id'];
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['full_name'] = $row['first_name'] . " " . $row['last_name'];
    $_SESSION['phone'] = $row['phone']; // Mobile number session mein save kiya
    header('location:products.php');
}
?>