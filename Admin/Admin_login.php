
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Western Side</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo h2 {
            color: #1e3c72;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .logo p { color: #666; }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1e3c72;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30,60,114,0.4);
        }
        .error { color: #e74c3c; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <i class="fas fa-tshirt" style="font-size: 48px; color: #1e3c72;"></i>
            <h2>Western Side</h2>
            <p>Admin Panel</p>
        </div>
        <form method="POST" action="">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <?php
            session_start();
            if(isset($_POST['login'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                // Simple authentication (replace with database check)
                if($username == 'admin' && $password == 'western123') {
                    $_SESSION['admin_loggedin'] = true;
                    header('Location: index.php');
                    exit();
                } else {
                    echo '<div class="error">Invalid credentials!</div>';
                }
            }
            ?>
        </form>
    </div>
</body>
</html> 
--> 