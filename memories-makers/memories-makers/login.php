<?php
session_start();
require_once __DIR__ . '/includes/auth_functions.php';

// إذا كان المستخدم مسجلاً بالفعل، توجيهه مباشرة إلى services.html
if (isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "services.html";</script>';
    exit();
}


$login_error = '';
$registered = isset($_GET['registered']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $login_error = 'Please enter both username and password';
    } elseif (loginUser($username, $password)) {
        $_SESSION['user_id'] = true;
        $_SESSION['username'] = $username;
        
        // استخدام JavaScript للتحويل الفوري بدون عرض رسالة الترحيب
        echo '<script>
            localStorage.setItem("loggedin", "true");
             localStorage.setItem("username", "' . $username . '");
            window.location.href = "services.html";
        </script>';
        exit();
    } else {
        $login_error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Memories Makers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <!-- استخدم نفس الهيدر الموجود في الموقع -->
    <header class="container-fluid resize">
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="/">
                    <img src="./images/logo.svg" alt="logo" class="logo">
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a href="index.html">Home</a></li>
                        <li class="nav-item"><a href="about.html">About Us</a></li>
                        <li class="nav-item"><a href="services.php">Services</a></li>
                        <li class="nav-item"><a href="about.html#team">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-auto">
                <a href="signup.php" class="btn-custom btn-outlined">Sign Up</a>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Welcome Back</h2>
                        
                        <?php if ($registered): ?>
                            <div class="alert alert-success">
                                Registration successful! Please log in.
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($login_error): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($login_error); ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log In</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- استخدم نفس الفوتر الموجود في الموقع -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>