<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db = new DB('categories');
$categories = $db->all();
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Categories</h2>
    <a href="CategoryForm.php" class="btn btn-primary">New Category</a>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $cat): ?>
        <tr>
          <td><?= $cat->id ?></td>
          <td><?= htmlspecialchars($cat->name) ?></td>
          <td><?= htmlspecialchars($cat->description) ?></td>
          <td><?= htmlspecialchars($cat->created_at ?? '') ?></td>
          <td>
            <a href="CategoryForm.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="CategoryDelete.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this category?');">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5" class="text-center text-muted py-3">No categories found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
