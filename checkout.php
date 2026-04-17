<?php
session_start();
require "includes/common.php";

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Cart se total amount nikalna
$query = "SELECT SUM(p.price) AS total FROM users_products up JOIN products p ON up.item_id = p.id WHERE up.user_id = '$user_id' AND up.status = 'Added To Cart'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$total_amount = $row['total'];

if($total_amount == 0 || $total_amount == null) {
    header('location: products.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        body { background-color: #f8f9fa; font-family: 'Andika', sans-serif; }
        .checkout-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 100px; margin-bottom: 50px; }
        .payment-option { border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 10px; transition: 0.3s; cursor: pointer; }
        .payment-option:hover { border-color: #1e3c72; background: #f8faff; }
        .payment-option label { cursor: pointer; width: 100%; margin: 0; }
        .form-control:focus { border-color: #1e3c72; box-shadow: 0 0 0 0.2rem rgba(30,60,114,0.25); }
    </style>
</head>
<body>
    <?php include 'includes/header_menu.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 checkout-box">
                <h2 class="text-center mb-2" style="font-family: 'Delius Swash Caps'; color: #1e3c72;">Secure Checkout</h2>
                
                <div class="bg-light p-3 rounded mb-3 border">
                    <h6 class="font-weight-bold"><i class="fas fa-tags text-warning"></i> Have a Coupon Code?</h6>
                    <div class="input-group mt-2">
                        <input type="text" id="coupon_input" class="form-control" placeholder="Enter Code (e.g. WELCOME10)" style="text-transform: uppercase;">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="button" onclick="applyCoupon()">Apply</button>
                        </div>
                    </div>
                    <p id="coupon_msg" class="mt-2 mb-0 font-weight-bold" style="font-size: 14px;"></p>
                </div>

                <h4 class="text-center mb-4">Total Amount: <span class="text-success font-weight-bold" id="display_total">₹<?php echo $total_amount; ?></span></h4>
                <hr>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fas fa-map-marker-alt text-danger mr-2"></i> Delivery Address</h5>
                    <small class="text-danger font-weight-bold"><em>* All fields are mandatory</em></small>
                </div>
                
                <form id="addressForm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control" id="del_name" value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" id="del_phone" pattern="[0-9]{10}" maxlength="10" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Pincode</label>
                            <input type="text" class="form-control" id="del_pincode" maxlength="6" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Town/City</label>
                            <input type="text" class="form-control" id="del_city" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Flat, House no., Building</label>
                        <input type="text" class="form-control" id="del_house" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Area, Street, Sector</label>
                        <input type="text" class="form-control" id="del_street" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>State</label>
                            <select class="form-control" id="del_state" required>
                                <option value="" disabled selected>-- Select State --</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Ladakh">Ladakh</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Country</label>
                            <input type="text" class="form-control" id="del_country" value="India" readonly>
                        </div>
                    </div>
                </form>

                <hr class="mt-4 mb-4">

                <h5 class="mb-3"><i class="fas fa-wallet text-info mr-2"></i> Payment Method</h5>
                <div class="payment-option">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="pay_online" value="online" checked>
                        <label class="form-check-label font-weight-bold" for="pay_online">
                            <i class="fas fa-credit-card text-primary mr-2"></i> Pay Online
                        </label>
                    </div>
                </div>

                <div class="payment-option">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="pay_cod" value="cod">
                        <label class="form-check-label font-weight-bold" for="pay_cod">
                            <i class="fas fa-money-bill-wave text-success mr-2"></i> Cash on Delivery (COD)
                        </label>
                    </div>
                </div>

                <button id="place-order-btn" class="btn btn-primary btn-lg btn-block mt-4" style="background: #1e3c72; border: none;">
                    Place Order
                </button>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var original_total = <?php echo $total_amount; ?>;
    var final_total = original_total;
    var applied_coupon_code = "NULL";
    var applied_discount_val = 0;

    function applyCoupon() {
        var code = document.getElementById('coupon_input').value.trim();
        var msgBox = document.getElementById('coupon_msg');
        var totalDisplay = document.getElementById('display_total');

        if(code === "") {
            msgBox.innerHTML = "Please enter code.";
            msgBox.className = "text-danger";
            return;
        }

        var formData = new FormData();
        formData.append('coupon_code', code);
        formData.append('cart_total', original_total);

        fetch('apply_coupon.php', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                final_total = data.new_total;
                applied_coupon_code = code.toUpperCase();
                applied_discount_val = data.discount;
                msgBox.innerHTML = data.message;
                msgBox.className = "text-success";
                totalDisplay.innerHTML = "₹" + final_total;
            } else {
                msgBox.innerHTML = data.message;
                msgBox.className = "text-danger";
            }
        });
    }

    document.getElementById('place-order-btn').onclick = function(e){
        e.preventDefault(); 
        var name = document.getElementById('del_name').value.trim();
        var phone = document.getElementById('del_phone').value.trim();
        var city = document.getElementById('del_city').value.trim();
        var state = document.getElementById('del_state').value;
        var pincode = document.getElementById('del_pincode').value.trim();
        
        // Dono field ka data liya
        var house = document.getElementById('del_house').value.trim();
        var street = document.getElementById('del_street').value.trim();
        
        if(!name || !phone || !city || !state || !pincode || !house || !street){
            alert("Please fill all mandatory address fields!");
            return false;
        }

        // Pura address ek sath joda
        var full_street_address = house + ", " + street;

        // Ab URL me pura address jayega
        var urlParams = "&address=" + encodeURIComponent(full_street_address) + "&city=" + encodeURIComponent(city) + "&state=" + encodeURIComponent(state) + "&pincode=" + encodeURIComponent(pincode) + "&coupon=" + encodeURIComponent(applied_coupon_code) + "&discount=" + encodeURIComponent(applied_discount_val);

        var payMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if(payMethod === 'cod') {
            window.location.href = "success.php?payment_mode=COD" + urlParams;
        } else {
            var options = {
                "key": "rzp_test_SaXWm3KFPoVDth", 
                "amount": final_total * 100, 
                "currency": "INR",
                "name": "Western-Side",
                "description": "Men's Fashion Purchase",
                "handler": function (response){
                    window.location.href = "success.php?payment_mode=Razorpay&payment_id=" + response.razorpay_payment_id + urlParams;
                },
                "prefill": {
                    "name": name,
                    "email": "<?php echo $_SESSION['email']; ?>",
                    "contact": phone
                },
                "theme": { "color": "#1e3c72" }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    }
    </script>
</body>
</html>