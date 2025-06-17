<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$dbOrder   = new DB('orders');
$dbUser    = new DB('users');
$dbProduct = new DB('products');

$users    = $dbUser->all();
$products = $dbProduct->all();

$errors  = [];
$success = '';
$data    = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = (object) $_POST;
    if (empty($_POST['user_id'])) {
        $errors[] = "User is required";
    }
    if (empty($_POST['product_id'])) {
        $errors[] = "Product is required";
    }
    if (!isset($_POST['quantity']) || !is_numeric($_POST['quantity']) || $_POST['quantity'] <= 0) {
        $errors[] = "Quantity must be a positive number";
    }
    if (empty($_POST['status'])) {
        $errors[] = "Status is required";
    }
    if (empty($errors)) {
        try {
            if (empty($_POST['id'])) {
                $dbOrder->store($_POST);
                $success = "Order created successfully.";
            } else {
                $dbOrder->update($_POST);
                $success = "Order updated successfully.";
            }
            header("Refresh:1; url=OrderList.php");
        } catch (Exception $e) {
            $errors[] = "Error saving order: " . $e->getMessage();
        }
    }
}

if (!empty($_GET['id'])) {
    $data = $dbOrder->find($_GET['id']);
}
?>
<div class="px-3">
  <div class="mb-3">
    <h2 class="h4"><?= !empty($_GET['id']) ? "Edit Order" : "New Order" ?></h2>
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
      <label class="form-label">User</label>
      <select name="user_id" class="form-select" required>
        <option value="">-- Select User --</option>
        <?php foreach ($users as $u): ?>
          <option value="<?= $u->id ?>" <?= (!empty($data) && $data->user_id == $u->id) ? 'selected' : '' ?>>
            <?= htmlspecialchars($u->name) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Product</label>
      <select name="product_id" class="form-select" required>
        <option value="">-- Select Product --</option>
        <?php foreach ($products as $p): ?>
          <option value="<?= $p->id ?>" <?= (!empty($data) && $data->product_id == $p->id) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p->name) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Quantity</label>
      <input type="number" name="quantity" value="<?= htmlspecialchars($data->quantity ?? '') ?>" class="form-control" min="1" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select name="status" class="form-select" required>
        <?php
        $statuses = ['pending','in_progress','completed'];
        foreach ($statuses as $st): ?>
          <option value="<?= $st ?>" <?= (!empty($data) && $data->status == $st) ? 'selected' : '' ?>>
            <?= ucfirst(str_replace('_',' ', $st)) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success"><?= !empty($_GET['id']) ? "Update" : "Create" ?></button>
    <a href="OrderList.php" class="btn btn-secondary ms-2">Back</a>
  </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
