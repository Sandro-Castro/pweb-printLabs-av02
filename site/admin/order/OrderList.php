<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$db = new DB('orders');

$searchField = $_GET['field'] ?? '';
$searchValue = $_GET['search'] ?? '';

if (!empty($searchField) && !empty($searchValue)) {
    $orders = $db->search([
        'field' => $searchField,
        'value' => $searchValue
    ]);
} else {
    $orders = $db->all();
}
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Orders</h2>
    <a href="OrderForm.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> New Order</a>
  </div>
  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="user_id" <?= $searchField === 'user_id' ? 'selected' : '' ?>>User ID</option>
          <option value="product_id" <?= $searchField === 'product_id' ? 'selected' : '' ?>>Product ID</option>
          <option value="status" <?= $searchField === 'status' ? 'selected' : '' ?>>Status</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="search" class="form-control"
               placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <a href="OrderList.php" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i> Reset</a>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>User ID</th>
          <th>Product ID</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $o): ?>
        <tr>
          <td><?= $o->id ?></td>
          <td><?= $o->user_id ?></td>
          <td><?= $o->product_id ?></td>
          <td><?= $o->quantity ?></td>
          <td><?= htmlspecialchars($o->status) ?></td>
          <td><?= htmlspecialchars($o->created_at ?? '') ?></td>
          <td>
            <a href="OrderForm.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
            <a href="OrderDelete.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this order?');"><i class="fa-solid fa-trash"></i> Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-muted py-3">No orders found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
