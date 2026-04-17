<?php
require "includes/common.php";
session_start();

// Security check: Agar login nahi hai toh wapas bhejo
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Form se naya data fetch aur sanitize karna
    $first = mysqli_real_escape_string($con, $_POST['firstName']);
    $last = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['eMail']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    // Check karna ki naya email kisi aur user ka toh nahi hai
    $email_check_query = "SELECT * FROM users WHERE email_id='$email' AND id != '$user_id'";
    $email_check_result = mysqli_query($con, $email_check_query);
    
    if (mysqli_num_rows($email_check_result) > 0) {
        // Agar email already maujood hai
        echo "<script>alert('This Email is already registered with another account!'); window.location.href='index.php';</script>";
        exit;
    } else {
        // Data update karna
        $update_query = "UPDATE users SET first_name='$first', last_name='$last', email_id='$email', phone='$phone' WHERE id='$user_id'";
        $run_update = mysqli_query($con, $update_query);

        if ($run_update) {
            // Nayi details ko session (navbar) mein update karna
            $_SESSION['email'] = $email;
            $_SESSION['full_name'] = $first . " " . $last;
            $_SESSION['phone'] = $phone;
            
            // Success hone par wapas bhejna
            echo "<script>alert('Profile Updated Successfully!'); window.location.href='index.php';</script>";
        } else {
            // Error hone par
            echo "<script>alert('Error updating profile!'); window.location.href='index.php';</script>";
        }
    }
} else {
    header('location: index.php');
}
?>