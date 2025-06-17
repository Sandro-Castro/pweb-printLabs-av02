<?php
// site/admin/header.php
$base = '/pweb-printLabs-av02/site/admin';

// Habilitar debug durante desenvolvimento:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PrintLab Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        
       >
  
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $base ?>/index.php">
      <!-- ✅ Logo -->
      <img src="" alt="Logo" width="50" height="50" class="me-2">
      <!-- ✅ Texto -->
      PrintLab Admin
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>/user/UserList.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>/category/CategoryList.php">Categories</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>/product/ProductList.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>/order/OrderList.php">Orders</a></li>
      </ul>
    </div>
  </div>
</nav>
  <main class="container">
