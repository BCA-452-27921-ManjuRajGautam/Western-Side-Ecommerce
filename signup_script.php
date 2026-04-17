<?php
require "includes/common.php";
session_start();

$email = mysqli_real_escape_string($con, $_POST['eMail']);
$pass = md5(mysqli_real_escape_string($con, $_POST['password'])); 
$first = mysqli_real_escape_string($con, $_POST['firstName']);
$last = mysqli_real_escape_string($con, $_POST['lastName']);
$phone = mysqli_real_escape_string($con, $_POST['phone']);

$query = "SELECT * FROM users WHERE email_id='$email' OR phone='$phone'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    if ($row['email_id'] == $email) {
        $m = "This Email is Already Registered!";
        header('location: index.php?error=' . urlencode($m) . '&type=email');
        exit;
    } else if ($row['phone'] == $phone) {
        $m = "This Mobile Number is Already Registered!";
        header('location: index.php?error=' . urlencode($m) . '&type=phone');
        exit;
    }
} else {
    $quer = "INSERT INTO users(email_id, first_name, last_name, phone, password) VALUES('$email', '$first', '$last', '$phone', '$pass')";
    mysqli_query($con, $quer);

    $user_id = mysqli_insert_id($con);
    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['full_name'] = $first . " " . $last;
    $_SESSION['phone'] = $phone;
    
    header('location:products.php');
}
?>