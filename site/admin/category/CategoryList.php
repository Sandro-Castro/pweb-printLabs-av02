<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$db = new DB('categories');

$searchField = $_GET['field'] ?? '';
$searchValue = $_GET['search'] ?? '';

if (!empty($searchField) && !empty($searchValue)) {
    $categories = $db->search([
        'field' => $searchField,
        'value' => $searchValue
    ]);
} else {
    $categories = $db->all();
}
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Categories</h2>
    <a href="CategoryForm.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> New Category</a>
  </div>
  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="name" <?= $searchField === 'name' ? 'selected' : '' ?>>Name</option>
          <option value="description" <?= $searchField === 'description' ? 'selected' : '' ?>>Description</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="search" class="form-control"
               placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <a href="CategoryList.php" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i> Reset</a>
      </div>
    </div>
  </form>

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
            <a href="CategoryForm.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
            <a href="CategoryDelete.php?id=<?= $cat->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this category?');"><i class="fa-solid fa-trash"></i> Delete</a>
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
