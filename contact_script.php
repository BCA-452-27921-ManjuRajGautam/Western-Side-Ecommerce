<?php
require("includes/common.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Form se data receive aur sanitize karna
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']); // Subject yahan fetch ho raha hai
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Database ke contact_messages table me subject ke sath insert karna
    $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    // Query run karna aur wapas about.php par bhejna message ke sath
    if (mysqli_query($con, $query)) {
        header('location: about.php?msg=success');
    } else {
        header('location: about.php?msg=error');
    }
} else {
    // Agar direct URL open ki jaye toh wapas bhej do
    header('location: about.php');
}
?>