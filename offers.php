<?php
session_start();
require "includes/common.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Western-Side | Special Offers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        body { background-color: #f8f9fa; font-family: 'Andika', sans-serif; }
        .coupon-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: 0.3s;
            border-left: 5px dashed #1e3c72;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .coupon-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .coupon-code-box {
            background: #eef2f7;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #1e3c72;
            border: 1px dashed #1e3c72;
            display: inline-block;
        }
        .copy-btn {
            background: #1e3c72;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
        }
        .copy-btn:hover { background: #152b52; }
    </style>
</head>
<body style="margin-bottom: 100px;">
    <?php include 'includes/header_menu.php'; ?>

    <div class="container" style="margin-top: 120px; min-height: 60vh;">
        <h2 class="text-center mb-2" style="font-family: 'Delius Swash Caps'; color: #1e3c72;">Exclusive Offers & Coupons</h2>
        <p class="text-center text-muted mb-5">Apply these promo codes at checkout to get amazing discounts!</p>

        <div class="row">
            <?php
            // Database se sirf ACTIVE aur valid date wale coupons nikalna
            $query = "SELECT * FROM coupons WHERE status = 'active' AND expires_at >= CURDATE() ORDER BY min_order ASC";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $code = htmlspecialchars($row['code']);
                    $type = $row['discount_type'];
                    $value = $row['discount_value'];
                    $min_order = $row['min_order'];
                    $expiry = date("d M Y", strtotime($row['expires_at']));

                    // Discount text set karna
                    if ($type == 'percent') {
                        $discount_text = "Get " . $value . "% OFF";
                    } else {
                        $discount_text = "Flat ₹" . $value . " OFF";
                    }
                    ?>
                    
                    <div class="col-md-6 col-lg-4">
                        <div class="coupon-card p-4">
                            <h4 class="text-success font-weight-bold"><i class="fas fa-tags mr-2"></i> <?php echo $discount_text; ?></h4>
                            <p class="text-muted mt-2 mb-1">On minimum order of <strong>₹<?php echo $min_order; ?></strong></p>
                            <p class="text-danger small"><i class="far fa-clock"></i> Valid till: <?php echo $expiry; ?></p>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="coupon-code-box" id="code_<?php echo $row['id']; ?>">
                                    <?php echo $code; ?>
                                </div>
                                <button class="copy-btn" onclick="copyCode('code_<?php echo $row['id']; ?>', this)">
                                    Copy
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo '<div class="col-12 text-center mt-5">
                        <h4 class="text-muted">Currently, there are no active offers. Check back later!</h4>
                      </div>';
            }
            ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        function copyCode(elementId, btnElement) {
            var copyText = document.getElementById(elementId).innerText.trim();
            
            navigator.clipboard.writeText(copyText).then(function() {
                var originalText = btnElement.innerHTML;
                btnElement.innerHTML = "<i class='fas fa-check'></i> Copied!";
                btnElement.style.background = "#28a745"; 
                
                setTimeout(function() {
                    btnElement.innerHTML = "Copy";
                    btnElement.style.background = "#1e3c72"; 
                }, 2000);
            }).catch(function(err) {
                alert("Oops! Unable to copy. Please copy it manually.");
            });
        }
    </script>
</body>
</html>