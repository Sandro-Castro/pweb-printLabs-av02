<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$dbOrders = new DB('orders');
$pdo = $dbOrders->getConnection();

$searchField = $_GET['field'] ?? '';
$searchValue = trim($_GET['search'] ?? '');

$allowedFields = [
    'user_id'       => 'o.user_id = ?',
    'product_id'    => 'o.product_id = ?',
    'status'        => 'o.status LIKE ?',
    'user_name'     => 'u.name LIKE ?',
    'product_name'  => 'p.name LIKE ?',
];

$whereSql = '';
$params = [];
if (!empty($searchField) && $searchValue !== '' && array_key_exists($searchField, $allowedFields)) {
    $clauseTemplate = $allowedFields[$searchField];
    if ($searchField === 'user_id' || $searchField === 'product_id') {
        if (ctype_digit($searchValue)) {
            $whereSql = "WHERE {$clauseTemplate}";
            $params[] = intval($searchValue);
        } else {
            $whereSql = "WHERE 0=1";
        }
    } else {
        $whereSql = "WHERE {$clauseTemplate}";
        $params[] = '%' . $searchValue . '%';
    }
}

$sql = "
SELECT 
    o.id,
    o.user_id,
    u.name AS user_name,
    o.product_id,
    p.name AS product_name,
    o.quantity,
    o.status,
    o.created_at
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN products p ON o.product_id = p.id
{$whereSql}
ORDER BY o.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$orders = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Orders</h2>
    <a href="OrderForm.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> New Order</a>
  </div>
  <form method="GET" class="mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="user_id" <?= $searchField === 'user_id' ? 'selected' : '' ?>>User ID</option>
          <option value="product_id" <?= $searchField === 'product_id' ? 'selected' : '' ?>>Product ID</option>
          <option value="status" <?= $searchField === 'status' ? 'selected' : '' ?>>Status</option>
          <option value="user_name" <?= $searchField === 'user_name' ? 'selected' : '' ?>>User Name</option>
          <option value="product_name" <?= $searchField === 'product_name' ? 'selected' : '' ?>>Product Name</option>
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
          <th>User</th>
          <th>Product</th>
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
          <td><?= htmlspecialchars($o->user_name) ?></td>
          <td><?= htmlspecialchars($o->product_name) ?></td>
          <td><?= htmlspecialchars($o->quantity) ?></td>
          <td>
            <?php if ($o->status === 'active'): ?>
              <span class="badge bg-success"><?= htmlspecialchars($o->status) ?></span>
            <?php elseif ($o->status === 'inactive'): ?>
              <span class="badge bg-secondary"><?= htmlspecialchars($o->status) ?></span>
            <?php else: ?>
              <?= htmlspecialchars($o->status) ?>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($o->created_at ?? '') ?></td>
          <td>
            <a href="OrderForm.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <a href="OrderDelete.php?id=<?= $o->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this order?');">
              <i class="fa-solid fa-trash"></i> Delete
            </a>
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
