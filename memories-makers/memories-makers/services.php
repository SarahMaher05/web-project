<?php
session_start();
require_once __DIR__ . '/includes/auth_functions.php';
redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/main.css" />
    <title>Pricing Plans</title>
  </head>
  <body>
    <!-- Header مع إضافة زر الخروج -->
    <header class="container-fluid resize">
      <div class="row align-items-center">
        <div class="col-auto">
          <a href="/">
            <img src="./images/logo.svg" alt="logo" class="logo" />
          </a>
        </div>
        <div class="col d-flex justify-content-center">
          <nav>
            <ul class="nav">
              <li class="nav-item"><a href="index.html">Home</a></li>
              <li class="nav-item"><a href="about.html">About Us</a></li>
              <li class="nav-item">
                <a href="services.php">Services</a>
              </li>
              <li class="nav-item">
                <a href="about.html#team">Contact Us</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-auto">
          <a href="logout.php" class="btn-custom btn-outlined">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
        </div>
      </div>
    </header>
    
    <!-- باقي محتوى صفحة الخدمات كما هو -->
    <!-- ... -->
    
    <!-- Bootstrap JavaScript -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>