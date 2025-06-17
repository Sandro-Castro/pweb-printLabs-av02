<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db      = new DB('users');
$errors  = [];
$success = '';
$data    = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = (object) $_POST;
    
    if (empty(trim($_POST['name']))) {
        $errors[] = "Name is required";
    }
    if (empty(trim($_POST['username']))) {
        $errors[] = "Username is required";
    }
    if (empty(trim($_POST['email']))) {
        $errors[] = "Email is required";
    }
   
    if (empty($_POST['id'])) {
        if (empty($_POST['password'])) {
            $errors[] = "Password is required for new user";
        }
    }
    if (empty($errors)) {
        try {
            if (empty($_POST['id'])) {
             
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $db->store($_POST);
                $success = "User created successfully.";
            } else {
               
                if (!empty($_POST['password'])) {
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                } else {
                    unset($_POST['password']);
                }
                $db->update($_POST);
                $success = "User updated successfully.";
            }
            
            header("Refresh:1; url=UserList.php");
        } catch (Exception $e) {
            $errors[] = "Error saving user: " . $e->getMessage();
        }
    }
}


if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}
?>
<div class="px-3">
  <div class="mb-3">
    <h2 class="h4"><?= !empty($_GET['id']) ? "Edit User" : "New User" ?></h2>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert alert-success">
      <?= htmlspecialchars($success) ?>
    </div>
  <?php endif; ?>

  <form method="post" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?= htmlspecialchars($data->id ?? '') ?>">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($data->name ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" value="<?= htmlspecialchars($data->username ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($data->email ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password <?= !empty($_GET['id']) ? "(leave blank to keep current)" : "" ?></label>
      <input type="password" name="password" class="form-control" <?= empty($_GET['id']) ? 'required' : '' ?>>
    </div>
    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role" class="form-select">
        <option value="customer" <?= (isset($data->role) && $data->role==='customer')?'selected':'' ?>>Customer</option>
        <option value="admin" <?= (isset($data->role) && $data->role==='admin')?'selected':'' ?>>Admin</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success"><?= !empty($_GET['id']) ? "Update" : "Create" ?></button>
    <a href="UserList.php" class="btn btn-secondary ms-2">Back</a>
  </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
