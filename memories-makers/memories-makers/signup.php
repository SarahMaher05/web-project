<?php
session_start();
require_once __DIR__ . '/includes/auth_functions.php';



$fromIndex = isset($_GET['from']) && $_GET['from'] === 'index';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        if (registerUser($username, $email, $password)) {
            header('Location: login.php?registered=1');
            exit();
        } else {
            $errors[] = 'Registration failed. Username or email may already exist.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Memories Makers</title>
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
                <a href="login.php" class="btn-custom btn-outlined">Sign in</a>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">Create Your Account</h2>
                        
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="signup.php">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>Already have an account? <a href="login.php">Log in</a></p>
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