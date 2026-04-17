<nav class="navbar fixed-top navbar-expand-sm navbar-dark" style="background-color:rgba(0,0,0,0.8); box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
    <div class="container">
        <a href="index.php" class="navbar-brand" style="font-family: 'Delius Swash Caps'; font-size: 24px;">Western-Side</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbar-drop" data-toggle="dropdown">Products</a>
                    <div class="dropdown-menu">
                        <a href="products.php#watch" class="dropdown-item">Watches</a>
                        <a href="products.php#shirt" class="dropdown-item">T-Shirts</a>
                        <a href="products.php#shoes" class="dropdown-item">Shoes</a>
                        <a href="products.php#headphones" class="dropdown-item">Headphones/Speakers</a>
                    </div>
                </li>
                <li class="nav-item"><a href="offers.php" class="nav-link">Offers</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>
                <?php if (isset($_SESSION['email'])) { ?>
                    <li class="nav-item"><a href="wishlist.php" class="nav-link"><i class="fa fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a href="cart.php" class="nav-link"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                <?php } ?>
            </ul>
            
            <ul class="nav navbar-nav ml-auto">
                <?php if (isset($_SESSION['email'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle fa-lg"></i> My Account
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="profileDropdown" style="min-width: 250px; border-radius: 10px;">
                            <div class="text-center mb-3">
                                <i class="fa fa-user-circle-o fa-3x text-warning"></i>
                                <h6 class="mt-2 mb-0 font-weight-bold"><?php echo $_SESSION['full_name']; ?></h6>
                                <small class="text-muted">Customer</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            <p class="small mb-1 text-muted"><i class="fa fa-envelope"></i> Email:</p>
                            <p class="small font-weight-bold"><?php echo $_SESSION['email']; ?></p>
                            
                            <p class="small mb-1 text-muted"><i class="fa fa-phone"></i> Mobile:</p>
                            <p class="small font-weight-bold"><?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Not Added'; ?></p>
                            
                            <div class="dropdown-divider"></div>
                            <a href="#" class="btn btn-warning btn-sm btn-block mt-2 text-white font-weight-bold" data-toggle="modal" data-target="#editProfile">
                                <i class="fa fa-pencil"></i> Edit Profile
                            </a>
                            <a href="logout_script.php" class="btn btn-danger btn-sm btn-block mt-2">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#signup"><i class="fa fa-user"></i> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#login"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (isset($_SESSION['email'])) { ?>
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="edit_profile_script.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstName" placeholder="New First Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required title="Please enter only alphabets">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastName" placeholder="New Last Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required title="Please enter only alphabets">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email address:</label>
                        <input type="email" class="form-control" name="eMail" value="<?php echo $_SESSION['email']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile Number:</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; ?>" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required title="Please enter exactly 10 digits">
                    </div>

                    <button type="submit" class="btn btn-warning text-white btn-block mt-3" name="Submit">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="login_script.php" method="post">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="lemail" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd" name="lpassword" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-secondary btn-block" name="Submit">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mr-auto">New User? <a href="#" data-toggle="modal" data-target="#signup" data-dismiss="modal">Sign Up</a></p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">
            <div class="modal-header">
                <h5 class="modal-title">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="signup_script.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="validation1">First Name</label>
                            <input type="text" class="form-control" id="validation1" name="firstName" placeholder="First Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required title="Please enter only alphabets">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="validation2">Last Name</label>
                            <input type="text" class="form-control" id="validation2" name="lastName" placeholder="Last Name" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" title="Please enter only alphabets">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="eMail" placeholder="Enter email" required>
                        <?php if (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] == 'email') { echo "<span class='text-danger font-weight-bold'>" . htmlspecialchars($_GET['error']) . "</span>"; } ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Mobile Number:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter 10-digit Mobile Number" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required title="Please enter exactly 10 digits">
                        <?php if (isset($_GET['error']) && isset($_GET['type']) && $_GET['type'] == 'phone') { echo "<span class='text-danger font-weight-bold'>" . htmlspecialchars($_GET['error']) . "</span>"; } ?>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" id="pwd_signup" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" required id="terms">
                        <label for="terms" class="form-check-label">Agree to Terms and Conditions</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3" name="Submit">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="mr-auto">Already Registered? <a href="#" data-toggle="modal" data-target="#login" data-dismiss="modal">Login</a></p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>