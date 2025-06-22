<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!empty($_SESSION['user_id']) && !empty($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/database/db.class.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors[] = "Username is required.";
    }
    if ($password === '') {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        $dbUser = new DB('users');

        $adminUser = $dbUser->findBy('username', 'admin');
        if (!$adminUser) {
            $dataAdmin = [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ];
            $dbUser->store($dataAdmin);
            $adminUser = $dbUser->findBy('username', 'admin');
        }

        $user = $dbUser->findBy('username', $username);
        if (!$user) {
            $errors[] = "Invalid username or password.";
        } else {
            if (!password_verify($password, $user->password)) {
                $errors[] = "Invalid username or password.";
            } else {
                if ($user->role !== 'admin') {
                    $errors[] = "Invalid username or password.";
                } else {
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['username'] = $user->username;
                    $_SESSION['role'] = $user->role;
                    header('Location: index.php');
                    exit;
                }
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - PrintLab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <style>
    body, html {
        height: 100%;
    }
    .login-container {
        height: 100%;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container login-container d-flex align-items-center justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 400px;">
      <div class="card-body">
        <div class="text-center mb-3">
          <img src="../assets/img/logo.png" alt="Logo PrintLabs" style="max-width: 150px;">
        </div>

        <h4 class="card-title mb-4 text-center">Admin Login</h4>

        <?php if (!empty($errors)): ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="post" novalidate>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($username ?? '') ?>"
                   class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-right-to-bracket"></i> Log In</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
