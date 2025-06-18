<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$db = new DB('orders');
$orders = $db->all();
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Orders</h2>
    <a href="OrderForm.php" class="btn btn-success">New Order</a>
  </div>
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
            <a href="OrderForm.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="OrderDelete.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this order?');">Delete</a>
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
