<?php
require ("includes/common.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wester-side | Online Shopping Site for Men</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
</head>
<body style="overflow-x:hidden; padding-bottom:100px;">
  <?php
        include 'includes/header_menu.php';
    ?>
  <div>
    <div class="container mt-5 ">
      <div class="row justify-content-around">
        <div class="col-md-5 mt-3">
          <h3 class="text-warning pt-3 title">Who We Are ?</h3>
          <hr />
          <img
            src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&h=400&q=80"
            class="img-fluid d-block rounded mx-auto image-thumbnail">
          <p class="mt-2">Welcome to Western-Side
Our Story
Western-Side is more than just an online store; it is a lifestyle destination. We started with a simple vision: premium and trendy men’s fashion should be accessible and affordable for everyone. In today's fast-paced world, where both style and comfort are essential, Western-Side brings together the best collection of clothing, watches, shoes, and accessories on a single platform.

Our Mission
Our mission is simple: "We sell Happiness." We want to ensure that every time you shop with Western-Side, you aren't just buying a product, but gaining confidence. We constantly update our inventory to reflect the latest fashion trends, ensuring you always stay ahead in style.

Why Choose Us?

Top-Notch Quality: We pay strict attention to the quality of every single product we offer.

Affordable Fashion: Premium looks that don't break the bank.

Seamless Experience: A smooth, fast, and secure online shopping experience, because your time and data are valuable.

Behind The Project (Developer's Note)
Western-Side was designed and developed as a modern e-commerce solution. This platform was built by Manju Raj Gautam as a final year BCA project. The primary objective is to demonstrate the resolution of a real-world business problem by combining a user-friendly frontend interface with a robust backend driven by PHP and MySQL. It represents the perfect synergy of technology and business application.</p>
        </div>
        <div class="col-md-5 mt-3">
          <span class="text-warning pt-3">
            <h1 class="title">LIVE SUPPORT</h1>
            <h3>24 hours|7 days a week| 365 days a year Live Technical Support</h3>
          </span>
          <hr>
          <p>We Are Here For You, Anytime!
At Western-Side, your shopping experience is our top priority. We understand that sometimes you might need a little help—whether it's choosing the right size, tracking your latest order, or processing a return. That’s why our dedicated Live Support team is always on standby to assist you.

How Can We Help You Today?

Instant Chat Assistance: Got a quick question? Connect with our support agents in real-time for immediate solutions.

Order Tracking & Updates: Stay informed about your package from our warehouse right to your doorstep.

Hassle-Free Returns & Exchanges: Not the perfect fit? Our team will guide you smoothly through our easy return policy.

Styling & Product Queries: Need more details about the fabric or a specific brand? Just ask!
          </p>

        </div>
      </div>
    </div>
  </div>
  <div class="container pb-3">
  </div>
  
  <div class="container mt-3 d-flex justify-content-center card pb-3 col-md-6 shadow-sm">
    <form class="col-md-12" action="contact_script.php" method="POST">
      <h3 class="text-warning pt-3 title mx-auto text-center">Contact Form</h3>
      <hr>
      
      <?php if(isset($_GET['msg']) && $_GET['msg'] == 'success'){ ?>
          <div class="alert alert-success text-center">Thank you! Your message has been sent successfully.</div>
      <?php } else if(isset($_GET['msg']) && $_GET['msg'] == 'error'){ ?>
          <div class="alert alert-danger text-center">Oops! Something went wrong. Please try again.</div>
      <?php } ?>

      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email" required>
      </div>

      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" placeholder="Enter Subject (e.g. Order Issue)" name="subject" required>
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your query here..." required></textarea>
      </div>
      <button type="submit" class="btn btn-warning text-white btn-block font-weight-bold">Submit Message</button>
    </form>
  </div>
  <br><br>

  <?php include 'includes/footer.php'?>
  </body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
  });
  $(document).ready(function () {

    if (window.location.href.indexOf('#login') != -1) {
      $('#login').modal('show');
    }

  });
</script>
<?php if(isset($_GET['error'])){ $z=$_GET['error']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
<?php if(isset($_GET['errorl'])){ $z=$_GET['errorl']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
</html>