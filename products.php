<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Western-Side | Online Shopping Site for Men</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'includes/header_menu.php';
include 'includes/check-if-added.php';
include 'includes/check-if-wishlisted.php';
?>
<div class="container" style="margin-top:65px">
         <div class="jumbotron text-center">
            <h1>Welcome to Western-Side!</h1>
            <p>We have wide range of products for you. No need to hunt around, we have all in one place</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <hr/>
        
    <div class="row text-center" id="watch">
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch1.jpg" alt="" class="img-fluid pb-1" >
                <div class="figure-caption mt-auto">
                    <h6>Guess 1875</h6>
                    <h6>Price :Rs 3000</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(1)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=1" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(1)) {
                            echo '<a href="wishlist_script.php?id=1" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=1" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch2.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Guest Watch</h6>
                    <h6>Price :Rs 2500</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(2)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=2" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(2)) {
                            echo '<a href="wishlist_script.php?id=2" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=2" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch3.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Panerai Watch</h6>
                    <h6>Price :Rs 3500</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(3)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=3" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(3)) {
                            echo '<a href="wishlist_script.php?id=3" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=3" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch4.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Nonos Watch</h6>
                    <h6>Price :Rs 1800</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(4)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=4" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(4)) {
                            echo '<a href="wishlist_script.php?id=4" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=4" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch7.jpg" alt="" class="img-fluid pb-1" >
                <div class="figure-caption mt-auto">
                    <h6>Titan Men's Elegance Watch</h6>
                    <h6>Price :Rs 3990</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(5)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=5" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(5)) {
                            echo '<a href="wishlist_script.php?id=5" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=5" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch6.jpg" alt="" class="img-fluid pb-1" >
                <div class="figure-caption mt-auto">
                    <h6>POEDAGAR Men Watch</h6>
                    <h6>Price :Rs 3414</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(6)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=6" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(6)) {
                            echo '<a href="wishlist_script.php?id=6" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=6" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch5.jpg" alt="" class="img-fluid pb-1" >
                <div class="figure-caption mt-auto">
                    <h6>OLEVS Mens Chronograph Watch</h6>
                    <h6>Price :Rs 3420</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(7)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=7" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(7)) {
                            echo '<a href="wishlist_script.php?id=7" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=7" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>

         <div class="col-md-3 col-6 py-2">
            <div class="card h-100 image-vertical-align">
                <img src="images/watch8.jpg" alt="" class="img-fluid pb-1" >
                <div class="figure-caption mt-auto">
                    <h6>Casio MTP-V001L-1B</h6>
                    <h6>Price :Rs 2436</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(8)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=8" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(8)) {
                            echo '<a href="wishlist_script.php?id=8" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=8" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="row text-center" id="shirt">
            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt1.jpg" alt="" class="img-fluid pb-1"  >
                    <div class="figure-caption mt-auto">
                    <h6>Levis</h6>
                    <h6>Price :Rs 1800</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(9)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=9" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(9)) {
                            echo '<a href="wishlist_script.php?id=9" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=9" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3">
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt2.jpg" alt="" class="img-fluid pb-1" >
                    <div class="figure-caption mt-auto">
                    <h6>Louis Philippe t-shirt</h6>
                    <h6>Price :Rs 2500</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(10)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=10" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(10)) {
                            echo '<a href="wishlist_script.php?id=10" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=10" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3">
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt3.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Highlander t-shirt</h6>
                        <h6>Price :Rs 500</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(11)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=11" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(11)) {
                                echo '<a href="wishlist_script.php?id=11" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=11" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt4.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>GUCCI White t-Shirt</h6>
                        <h6>Price :Rs 2300</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(12)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=12" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(12)) {
                                echo '<a href="wishlist_script.php?id=12" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=12" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt5.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Paradise Men Oversized T-Shirt </h6>
                        <h6>Price :Rs 800</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(13)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=13" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(13)) {
                                echo '<a href="wishlist_script.php?id=13" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=13" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        
            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt6.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Wave-Tactile Oversized T-Shirt - XL</h6>
                        <h6>Price :Rs 1200</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(14)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=14" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(14)) {
                                echo '<a href="wishlist_script.php?id=14" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=14" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt7.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>NOBERO Graphic Cotton T-shirt</h6>
                        <h6>Price :Rs 950</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(15)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=15" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(15)) {
                                echo '<a href="wishlist_script.php?id=15" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=15" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/shirt8.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Trond Graphic Oversized T-shirt</h6>
                        <h6>Price :Rs 750</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(16)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=16" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(16)) {
                                echo '<a href="wishlist_script.php?id=16" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=16" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
    </div> <div class="row text-center" id="shoes" >
        <div class="col-md-3 col-6 py-3">
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe1.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Nike White Sneaker</h6>
                    <h6>Price :Rs 8000</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(17)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=17" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(17)) {
                            echo '<a href="wishlist_script.php?id=17" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=17" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-3">
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe2.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Nike White Shoes</h6>
                    <h6>Price :Rs 7500</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(18)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=18" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(18)) {
                            echo '<a href="wishlist_script.php?id=18" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=18" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-3">
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe3.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                    <h6>Nike Yellow Sneaker</h6>
                    <h6>Price :Rs 7000</h6>
                    <?php if (!isset($_SESSION['email'])) {?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                    <?php } else {
                        if (check_if_added_to_cart(19)) {
                            echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                        } else {
                            echo '<a href="cart-add.php?id=19" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                        }
                        if (check_if_wishlisted(19)) {
                            echo '<a href="wishlist_script.php?id=19" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                        } else {
                            echo '<a href="wishlist_script.php?id=19" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 py-3" >
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe4.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                <h6>Nike Sneaker</h6>
            <h6>Price :Rs 6000</h6>
            <?php if (!isset($_SESSION['email'])) {?>
                <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
            <?php } else {
                if (check_if_added_to_cart(20)) {
                    echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                } else {
                    echo '<a href="cart-add.php?id=20" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                }
                if (check_if_wishlisted(20)) {
                    echo '<a href="wishlist_script.php?id=20" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                } else {
                    echo '<a href="wishlist_script.php?id=20" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                }
            } ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 py-3" >
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe5.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                <h6>RedTape Lifestyle Sneakers</h6>
            <h6>Price :Rs 2999</h6>
            <?php if (!isset($_SESSION['email'])) {?>
                <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
            <?php } else {
                if (check_if_added_to_cart(21)) {
                    echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                } else {
                    echo '<a href="cart-add.php?id=21" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                }
                if (check_if_wishlisted(21)) {
                    echo '<a href="wishlist_script.php?id=21" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                } else {
                    echo '<a href="wishlist_script.php?id=21" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                }
            } ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 py-3" >
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe6.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                <h6>ASIAN Casual Shoes for Men</h6>
            <h6>Price :Rs 1299</h6>
            <?php if (!isset($_SESSION['email'])) {?>
                <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
            <?php } else {
                if (check_if_added_to_cart(22)) {
                    echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                } else {
                    echo '<a href="cart-add.php?id=22" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                }
                if (check_if_wishlisted(22)) {
                    echo '<a href="wishlist_script.php?id=22" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                } else {
                    echo '<a href="wishlist_script.php?id=22" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                }
            } ?>
                </div>
            </div>
        </div>

            <div class="col-md-3 col-6 py-3" >
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe7.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                <h6>U.S. Polo Assn. Colourblocked Sneakers</h6>
            <h6>Price :Rs 4299</h6>
            <?php if (!isset($_SESSION['email'])) {?>
                <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
            <?php } else {
                if (check_if_added_to_cart(23)) {
                    echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                } else {
                    echo '<a href="cart-add.php?id=23" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                }
                if (check_if_wishlisted(23)) {
                    echo '<a href="wishlist_script.php?id=23" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                } else {
                    echo '<a href="wishlist_script.php?id=23" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                }
            } ?>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6 py-3" >
            <div class="card h-100 image-vertical-align">
                <img src="images/shoe8.jpg" alt="" class="img-fluid pb-1">
                <div class="figure-caption mt-auto">
                <h6>U.S. Polo Assn. Men Clemt Sneakers</h6>
            <h6>Price :Rs 3799</h6>
            <?php if (!isset($_SESSION['email'])) {?>
                <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
            <?php } else {
                if (check_if_added_to_cart(24)) {
                    echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                } else {
                    echo '<a href="cart-add.php?id=24" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                }
                if (check_if_wishlisted(24)) {
                    echo '<a href="wishlist_script.php?id=24" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                } else {
                    echo '<a href="wishlist_script.php?id=24" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                }
            } ?>
                </div>
            </div>
        </div>
    </div> <div class="row text-center" id="headphones">
            <div class="col-md-3 col-6 py-3" >
                <div class="card h-100 image-vertical-align">
                    <img src="images/sp1.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Beats Headphone</h6>
                        <h6>Price :Rs 22,500</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(25)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=25" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(25)) {
                                echo '<a href="wishlist_script.php?id=25" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=25" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3">
                <div class="card h-100 image-vertical-align">
                    <img src="images/sp2.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Zolo Headphone</h6>
                        <h6>Price :Rs 4500</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(26)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=26" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(26)) {
                                echo '<a href="wishlist_script.php?id=26" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=26" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3">
                <div class="card h-100 image-vertical-align">
                    <img src="images/sp3.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Sony Speaker</h6>
                        <h6>Price :Rs 10,500</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(27)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=27" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(27)) {
                                echo '<a href="wishlist_script.php?id=27" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=27" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 py-3">
                <div class="card h-100 image-vertical-align">
                    <img src="images/sp4.jpg" alt="" class="img-fluid pb-1">
                    <div class="figure-caption mt-auto">
                        <h6>Airpods</h6>
                        <h6>Price :Rs 15,000</h6>
                        <?php if (!isset($_SESSION['email'])) {?>
                            <p><a href="index.php#login" role="button" class="btn btn-warning text-white btn-block">Add To Cart</a></p>
                        <?php } else {
                            if (check_if_added_to_cart(28)) {
                                echo '<a href="#" class="btn btn-warning text-white btn-block mb-2" disabled>Added to cart</a>';
                            } else {
                                echo '<a href="cart-add.php?id=28" name="add" value="add" class="btn btn-warning text-white btn-block mb-2">Add to cart</a>';
                            }
                            if (check_if_wishlisted(28)) {
                                echo '<a href="wishlist_script.php?id=28" class="btn btn-danger text-white btn-block"><i class="fa fa-heart"></i> Wishlisted</a>';
                            } else {
                                echo '<a href="wishlist_script.php?id=28" class="btn btn-outline-danger btn-block"><i class="fa fa-heart-o"></i> Wishlist</a>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
    </div> </div> <?php include 'includes/footer.php'?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>
<?php if (isset($_GET['error'])) {$z = $_GET['error'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . htmlspecialchars($z) . "')</script>";}?>
<?php if (isset($_GET['errorl'])) {$z = $_GET['errorl'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . htmlspecialchars($z) . "')</script>";}?>
</body>
</html>