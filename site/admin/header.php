<?php

$base = '/pweb-printLabs-av02/site/admin';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$isLoggedIn = !empty($_SESSION['user_id']) && !empty($_SESSION['role']);
$isAdmin = $isLoggedIn && $_SESSION['role'] === 'admin';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PrintLab Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= $base ?>/../assets/CSS/styles.css">

</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="<?= $base ?>/index.php">
        <img src="<?= $base ?>/../assets/img/logo.png" alt="Logo" width="65" height="65" class="me-2">
        <span class="fs-4 fw-bold">PrintLab Admin</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
        aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if ($isAdmin): ?>
            <li class="nav-item"><a class="nav-link fs-5" href="<?= $base ?>/user/UserList.php">Users</a></li>
            <li class="nav-item"><a class="nav-link fs-5" href="<?= $base ?>/category/CategoryList.php">Categories</a>
            </li>
            <li class="nav-item"><a class="nav-link fs-5" href="<?= $base ?>/product/ProductList.php">Products</a></li>
            <li class="nav-item"><a class="nav-link fs-5" href="<?= $base ?>/order/OrderList.php">Orders</a></li>
          <?php endif; ?>
        </ul>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <?php if ($isAdmin): ?>
            <li class="nav-item d-flex align-items-center">
              <span class="navbar-text me-3 fs-5">
                Logged in as <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong>
              </span>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger fs-5" href="<?= $base ?>/logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $base ?>/login.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container">