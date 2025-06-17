<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db = new DB('products');
$products = $db->all();
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Products</h2>
    <a href="ProductForm.php" class="btn btn-primary">New Product</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category ID</th>
          <th>Image</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($products)): ?>
        <?php foreach ($products as $p): ?>
        <tr>
          <td><?= $p->id ?></td>
          <td><?= htmlspecialchars($p->name) ?></td>
          <td>$<?= number_format($p->price, 2) ?></td>
          <td><?= $p->category_id ?></td>
          <td>
            <?php if (!empty($p->image)): ?>
              <img src="/assets/img/products/<?= htmlspecialchars($p->image) ?>" alt="" style="width: 50px; height:50px; object-fit:cover;">
            <?php else: ?>
              <span class="text-muted">No Image</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($p->created_at ?? '') ?></td>
          <td>
            <a href="ProductForm.php?id=<?= $p->id ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="ProductDelete.php?id=<?= $p->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this product?');">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-muted py-3">No products found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
