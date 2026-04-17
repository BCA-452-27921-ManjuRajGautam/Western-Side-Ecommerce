-- ============================================
-- WESTER-SIDE ECOMMERCE - COMPLETE DATABASE
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET FOREIGN_KEY_CHECKS = 0;

-- Drop all old tables
DROP TABLE IF EXISTS `users_products`;
DROP TABLE IF EXISTS `product_reviews`;
DROP TABLE IF EXISTS `product_images`;
DROP TABLE IF EXISTS `order_items`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `coupons`;
DROP TABLE IF EXISTS `wishlist`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `categories`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `admins`;
DROP TABLE IF EXISTS `banners`;
DROP TABLE IF EXISTS `contact_messages`;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- 1. ADMINS TABLE
-- ============================================
CREATE TABLE `admins` (
  `id`         int(11)      NOT NULL AUTO_INCREMENT,
  `username`   varchar(50)  NOT NULL,
  `email`      varchar(100) NOT NULL,
  `password`   varchar(255) NOT NULL,
  `role`       enum('superadmin','admin') DEFAULT 'admin',
  `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'superadmin', 'admin@westerside.com', 'e10adc3949ba59abbe56e057f20f883e', 'superadmin'),
(2, 'manager',    'manager@westerside.com','e10adc3949ba59abbe56e057f20f883e', 'admin');
-- password for both = 123456 (md5)

-- ============================================
-- 2. CATEGORIES TABLE
-- ============================================
CREATE TABLE `categories` (
  `id`          int(11)     NOT NULL AUTO_INCREMENT,
  `name`        varchar(50) NOT NULL,
  `slug`        varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon`        varchar(50)  DEFAULT NULL,
  `status`      enum('active','inactive') DEFAULT 'active',
  `created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `status`) VALUES
(1, 'T-Shirts',  'tshirt', 'Men\'s casual and formal t-shirts', 'fa-tshirt',      'active'),
(2, 'Watches',   'watch',  'Luxury and casual men\'s watches',  'fa-clock-o',     'active'),
(3, 'Shoes',     'shoes',  'Sneakers, formal and casual shoes', 'fa-soccer-ball-o','active'),
(4, 'Electronics','other', 'Headphones, speakers and gadgets',  'fa-headphones',  'active');

-- ============================================
-- 3. PRODUCTS TABLE (enhanced)
-- ============================================
CREATE TABLE `products` (
  `id`          int(11)       NOT NULL AUTO_INCREMENT,
  `name`        varchar(150)  NOT NULL,
  `description` text          DEFAULT NULL,
  `price`       int(11)       NOT NULL,
  `old_price`   int(11)       DEFAULT NULL,
  `category`    varchar(20)   DEFAULT 'other',
  `brand`       varchar(50)   DEFAULT NULL,
  `stock`       int(11)       DEFAULT 0,
  `image`       varchar(100)  DEFAULT 'default.jpg',
  `is_featured` tinyint(1)    DEFAULT 0,
  `status`      enum('active','inactive') DEFAULT 'active',
  `created_at`  timestamp     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `products` (`id`,`name`,`description`,`price`,`old_price`,`category`,`brand`,`stock`,`image`,`is_featured`,`status`) VALUES
-- Watches
(1,  'Guess 1875',                        'Classic analog watch with leather strap',           3000, 3500,  'watch',  'Guess',    15, 'guess1875.jpg',     1, 'active'),
(2,  'Guest Watch',                       'Stylish guest series timepiece',                    2500, 3000,  'watch',  'Guest',    10, 'guest.jpg',         0, 'active'),
(3,  'Panerai Watch',                     'Premium Italian luxury watch',                      3500, 4000,  'watch',  'Panerai',  8,  'panerai.jpg',       1, 'active'),
(4,  'Nonos Watch',                       'Minimalist design everyday watch',                  1800, 2200,  'watch',  'Nonos',    20, 'nonos.jpg',         0, 'active'),
(5,  'Titan Mens Elegance Watch',         'Black dial elegant watch - 38mm',                   3990, 4500,  'watch',  'Titan',    12, 'titan.jpg',         1, 'active'),
(6,  'POEDAGAR Men Watch',                'Top brand luxury chronograph',                      3414, 4000,  'watch',  'POEDAGAR', 9,  'poedagar.jpg',      0, 'active'),
(7,  'OLEVS Mens Chronograph Watch',      'Multi-function chronograph sports watch',           3420, 3900,  'watch',  'OLEVS',    7,  'olevs.jpg',         0, 'active'),
(8,  'Casio MTP-V001L-1B',               'Black leather strap classic Casio',                 2436, 2800,  'watch',  'Casio',    25, 'casio.jpg',         1, 'active'),
-- T-Shirts
(9,  'Levis Classic T-Shirt',             'Premium cotton Levis regular fit tee',              1800, 2200,  'tshirt', 'Levis',    30, 'levis.jpg',         1, 'active'),
(10, 'Louis Philippe T-Shirt',            'Formal cotton blend premium t-shirt',               2500, 3000,  'tshirt', 'Louis Philippe', 18, 'lp.jpg',       1, 'active'),
(11, 'Highlander T-Shirt',               'Casual everyday budget-friendly tee',                500,  700,   'tshirt', 'Highlander',40, 'highlander.jpg',   0, 'active'),
(12, 'GUCCI White T-Shirt',              'Premium luxury designer white tee',                  2300, 2800,  'tshirt', 'GUCCI',    5,  'gucci.jpg',         1, 'active'),
(13, 'Paradise Oversized T-Shirt',       'Trendy oversized printed men\'s tee',                800,  1000,  'tshirt', 'Paradise', 35, 'paradise.jpg',      0, 'active'),
(14, 'Wave-Tactile Oversized T-Shirt',   'Oversized XL wave graphic tee',                     1200, 1500,  'tshirt', 'Wave',     22, 'wave.jpg',          0, 'active'),
(15, 'NOBERO Graphic Cotton T-Shirt',    'Oversized graphic printed cotton tee',               950,  1200,  'tshirt', 'NOBERO',   28, 'nobero.jpg',        0, 'active'),
(16, 'Trond Graphic Oversized T-Shirt',  'Trendy oversized graphic printed tee',               750,  950,   'tshirt', 'Trond',    33, 'trond.jpg',         0, 'active'),
-- Shoes
(17, 'Nike White Sneaker',               'Classic Nike white lace-up sneakers',                8000, 9500,  'shoes',  'Nike',     14, 'nike_white.jpg',    1, 'active'),
(18, 'Nike White Shoes',                 'Nike everyday comfortable white shoes',              7500, 8500,  'shoes',  'Nike',     11, 'nike_ws.jpg',       0, 'active'),
(19, 'Nike Yellow Sneaker',              'Bold yellow Nike statement sneakers',                7000, 8000,  'shoes',  'Nike',     9,  'nike_yellow.jpg',   0, 'active'),
(20, 'Nike Brown Sneaker',               'Earthy tone Nike casual sneakers',                   6000, 7000,  'shoes',  'Nike',     13, 'nike_brown.jpg',    0, 'active'),
(21, 'RedTape Lifestyle Sneakers',       'Stylish RedTape casual lifestyle shoes',             2999, 3500,  'shoes',  'RedTape',  20, 'redtape.jpg',       1, 'active'),
(22, 'ASIAN Memory Foam Sneakers',       'Comfortable memory foam casual shoes',               1299, 1599,  'shoes',  'ASIAN',    40, 'asian.jpg',         0, 'active'),
(23, 'U.S. Polo Colourblocked Sneakers', 'White colourblocked premium sneakers',               4299, 5000,  'shoes',  'U.S. Polo',16, 'uspolo1.jpg',       1, 'active'),
(24, 'U.S. Polo Clemt 3.0 Sneakers',    'Solid premium U.S. Polo sneakers',                   3799, 4500,  'shoes',  'U.S. Polo',12, 'uspolo2.jpg',       0, 'active'),
-- Electronics
(25, 'Beats Headphone',                  'Premium bass-heavy over-ear headphones',            22500,25000,  'other',  'Beats',    6,  'beats.jpg',         1, 'active'),
(26, 'Zolo Headphone',                   'Budget wireless over-ear headphones',                4500, 5500,  'other',  'Zolo',     15, 'zolo.jpg',          0, 'active'),
(27, 'Sony Speaker',                     'Portable Bluetooth Sony speaker',                   10500,12000,  'other',  'Sony',     10, 'sony.jpg',          1, 'active'),
(28, 'Airpods',                          'Apple wireless earbuds with charging case',         15000,18000,  'other',  'Apple',    8,  'airpods.jpg',       1, 'active');

-- ============================================
-- 4. USERS TABLE (enhanced)
-- ============================================
CREATE TABLE `users` (
  `id`                int(11)      NOT NULL AUTO_INCREMENT,
  `first_name`        varchar(20)  NOT NULL,
  `last_name`         varchar(20)  DEFAULT NULL,
  `email_id`          varchar(255) NOT NULL,
  `phone`             varchar(15)  DEFAULT NULL,
  `address`           varchar(255) DEFAULT NULL,
  `city`              varchar(50)  DEFAULT NULL,
  `pincode`           varchar(10)  DEFAULT NULL,
  `password`          varchar(255) NOT NULL,
  `profile_pic`       varchar(100) DEFAULT 'default_user.jpg',
  `status`            enum('active','blocked') DEFAULT 'active',
  `registration_time` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`,`first_name`,`last_name`,`email_id`,`phone`,`address`,`city`,`pincode`,`password`,`status`) VALUES
(65, 'Reys',  'Rudt', 'sharew5m123@gmail.com', '9876543210', '12 MG Road',      'Mumbai',    '400001', 'e4f194cba29960e12d8b8f1bfedc972b', 'active'),
(66, 'Werty', 'Erty', 'sgah234@gmail.com',     '9123456780', '45 Brigade Road', 'Bangalore', '560001', 'e10adc3949ba59abbe56e057f20f883e', 'active'),
(67, 'Sham',  'Das',  'sham1234@gmail.com',    '9988776655', '78 Park Street',  'Kolkata',   '700016', 'e10adc3949ba59abbe56e057f20f883e', 'active');

-- ============================================
-- 5. ORDERS TABLE
-- ============================================
CREATE TABLE `orders` (
  `id`             int(11)      NOT NULL AUTO_INCREMENT,
  `user_id`        int(11)      NOT NULL,
  `total_amount`   int(11)      NOT NULL,
  `status`         enum('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `payment_method` enum('COD','UPI','Card','Netbanking') DEFAULT 'COD',
  `payment_status` enum('Pending','Paid','Failed') DEFAULT 'Pending',
  `address`        varchar(255) DEFAULT NULL,
  `city`           varchar(50)  DEFAULT NULL,
  `pincode`        varchar(10)  DEFAULT NULL,
  `coupon_code`    varchar(20)  DEFAULT NULL,
  `discount`       int(11)      DEFAULT 0,
  `created_at`     timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `orders` (`id`,`user_id`,`total_amount`,`status`,`payment_method`,`payment_status`,`address`,`city`,`pincode`) VALUES
(1, 67, 9414,  'Delivered',  'UPI', 'Paid',    '78 Park Street', 'Kolkata',   '700016'),
(2, 67, 3990,  'Shipped',    'COD', 'Pending', '78 Park Street', 'Kolkata',   '700016'),
(3, 66, 2500,  'Processing', 'Card','Paid',    '45 Brigade Road','Bangalore', '560001'),
(4, 65, 8000,  'Pending',    'UPI', 'Paid',    '12 MG Road',     'Mumbai',    '400001'),
(5, 67, 1800,  'Delivered',  'COD', 'Paid',    '78 Park Street', 'Kolkata',   '700016');

-- ============================================
-- 6. ORDER ITEMS TABLE
-- ============================================
CREATE TABLE `order_items` (
  `id`         int(11) NOT NULL AUTO_INCREMENT,
  `order_id`   int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity`   int(11) DEFAULT 1,
  `price`      int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id`   (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`)   REFERENCES `orders`   (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `order_items` (`order_id`,`product_id`,`quantity`,`price`) VALUES
(1, 6, 1, 3414),
(1, 1, 1, 3000),
(1, 2, 1, 3000),
(2, 5, 1, 3990),
(3, 10,1, 2500),
(4, 17,1, 8000),
(5, 9, 1, 1800);

-- ============================================
-- 7. USERS_PRODUCTS (cart) TABLE
-- ============================================
CREATE TABLE `users_products` (
  `id`      int(11)                           NOT NULL AUTO_INCREMENT,
  `user_id` int(11)                           DEFAULT NULL,
  `item_id` int(11)                           DEFAULT NULL,
  `quantity` int(11)                          DEFAULT 1,
  `status`  enum('Added To Cart','Confirmed') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id`    (`user_id`),
  KEY `product_id` (`item_id`),
  CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users`    (`id`),
  CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users_products` (`id`,`user_id`,`item_id`,`quantity`,`status`) VALUES
(11, 67, 6,  1, 'Confirmed'),
(17, 67, 1,  1, 'Confirmed'),
(18, 67, 5,  1, 'Confirmed'),
(19, 67, 6,  1, 'Confirmed'),
(20, 67, 1,  2, 'Confirmed'),
(23, 67, 1,  1, 'Confirmed'),
(24, 67, 2,  1, 'Confirmed'),
(25, 67, 9,  1, 'Confirmed');

-- ============================================
-- 8. WISHLIST TABLE
-- ============================================
CREATE TABLE `wishlist` (
  `id`         int(11)   NOT NULL AUTO_INCREMENT,
  `user_id`    int(11)   NOT NULL,
  `product_id` int(11)   NOT NULL,
  `added_at`   timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id`    (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`)    REFERENCES `users`    (`id`),
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `wishlist` (`user_id`,`product_id`) VALUES
(67, 3),
(67, 12),
(67, 17),
(66, 25),
(65, 5);

-- ============================================
-- 9. PRODUCT REVIEWS TABLE
-- ============================================
CREATE TABLE `product_reviews` (
  `id`         int(11)  NOT NULL AUTO_INCREMENT,
  `product_id` int(11)  NOT NULL,
  `user_id`    int(11)  NOT NULL,
  `rating`     tinyint(1) DEFAULT 5,
  `review`     text     DEFAULT NULL,
  `status`     enum('approved','pending','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id`    (`user_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`)    REFERENCES `users`    (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `product_reviews` (`product_id`,`user_id`,`rating`,`review`,`status`) VALUES
(1,  67, 5, 'Amazing watch, loved the quality!',          'approved'),
(5,  67, 4, 'Great watch, slightly expensive but worth it','approved'),
(9,  66, 5, 'Best Levis tee I have ever bought',          'approved'),
(17, 65, 5, 'Nike sneakers are always top quality',       'approved'),
(25, 67, 4, 'Beats headphones are fantastic for bass',    'pending'),
(12, 66, 3, 'Good quality but price is high',             'approved');

-- ============================================
-- 10. COUPONS TABLE
-- ============================================
CREATE TABLE `coupons` (
  `id`              int(11)     NOT NULL AUTO_INCREMENT,
  `code`            varchar(20) NOT NULL,
  `discount_type`   enum('percent','flat') DEFAULT 'percent',
  `discount_value`  int(11)     NOT NULL,
  `min_order`       int(11)     DEFAULT 0,
  `max_uses`        int(11)     DEFAULT 100,
  `used_count`      int(11)     DEFAULT 0,
  `status`          enum('active','inactive') DEFAULT 'active',
  `expires_at`      date        DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `coupons` (`code`,`discount_type`,`discount_value`,`min_order`,`max_uses`,`used_count`,`status`,`expires_at`) VALUES
('WELCOME10',  'percent', 10,   500,  200, 45,  'active',   '2026-12-31'),
('FLAT200',    'flat',    200,  1000, 100, 22,  'active',   '2026-06-30'),
('NIKE500',    'flat',    500,  5000, 50,  8,   'active',   '2026-09-30'),
('SAVE20',     'percent', 20,   2000, 75,  31,  'active',   '2026-08-31'),
('FESTIVE15',  'percent', 15,   1500, 150, 67,  'inactive', '2025-11-01');

-- ============================================
-- 11. BANNERS TABLE
-- ============================================
CREATE TABLE `banners` (
  `id`         int(11)      NOT NULL AUTO_INCREMENT,
  `title`      varchar(100) NOT NULL,
  `subtitle`   varchar(200) DEFAULT NULL,
  `image`      varchar(100) DEFAULT NULL,
  `link`       varchar(200) DEFAULT '#',
  `position`   int(11)      DEFAULT 1,
  `status`     enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banners` (`title`,`subtitle`,`image`,`link`,`position`,`status`) VALUES
('New Watch Collection',  'Luxury watches up to 20% off',     'banner_watch.jpg',  'watches.php', 1, 'active'),
('Summer T-Shirt Sale',   'Buy 2 get 1 free on all t-shirts', 'banner_tshirt.jpg', 'tshirts.php', 2, 'active'),
('Nike Sneakers Are Back','Latest Nike collection now live',   'banner_shoes.jpg',  'shoes.php',   3, 'active');

-- ============================================
-- 12. CONTACT MESSAGES TABLE
-- ============================================
CREATE TABLE `contact_messages` (
  `id`         int(11)      NOT NULL AUTO_INCREMENT,
  `name`       varchar(100) NOT NULL,
  `email`      varchar(150) NOT NULL,
  `subject`    varchar(200) DEFAULT NULL,
  `message`    text         NOT NULL,
  `is_read`    tinyint(1)   DEFAULT 0,
  `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `contact_messages` (`name`,`email`,`subject`,`message`,`is_read`) VALUES
('Rahul Sharma',  'rahul@gmail.com',  'Order not received',  'I placed order 3 days ago but still not received', 0),
('Priya Singh',   'priya@gmail.com',  'Return request',      'I want to return my Nike shoes, size issue',        0),
('Amit Kumar',    'amit@gmail.com',   'Coupon not working',  'The coupon FLAT200 is not applying on checkout',    1);

-- ============================================
-- AUTO INCREMENT
-- ============================================
ALTER TABLE `admins`           MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `categories`       MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `products`         MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
ALTER TABLE `users`            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
ALTER TABLE `orders`           MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `order_items`      MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
ALTER TABLE `users_products`   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
ALTER TABLE `wishlist`         MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `product_reviews`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `coupons`          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `banners`          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `contact_messages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;