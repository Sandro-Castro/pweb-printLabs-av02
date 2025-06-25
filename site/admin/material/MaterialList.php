<?php
require_once __DIR__ . '/../auth.php';          
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db = new DB('materials');

$searchField = $_GET['field'] ?? '';
$searchValue = $_GET['search'] ?? '';

if (!empty($searchField) && !empty($searchValue)) {
    $materials = $db->search([
        'field' => $searchField,
        'value' => $searchValue
    ]);
} else {
    $materials = $db->all();
}
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Materials</h2>
    <a href="MaterialForm.php" class="btn btn-success">
      <i class="fa-solid fa-plus"></i> New Material
    </a>
  </div>

  <form method="GET" class="mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="name" <?= $searchField === 'name' ? 'selected' : '' ?>>Name</option>
          <option value="type" <?= $searchField === 'type' ? 'selected' : '' ?>>Type</option>
          <option value="color" <?= $searchField === 'color' ? 'selected' : '' ?>>Color</option>
          <option value="status" <?= $searchField === 'status' ? 'selected' : '' ?>>Status</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="search" class="form-control"
               placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success">
          <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        <a href="MaterialList.php" class="btn btn-outline-secondary">
          <i class="fa-solid fa-xmark"></i> Reset
        </a>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Color</th>
          <th>Price/gram</th>
          <th>Stock Qty</th>
          <th>Status</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($materials)): ?>
        <?php foreach ($materials as $m): ?>
        <tr>
          <td><?= $m->id ?></td>
          <td><?= htmlspecialchars($m->name) ?></td>
          <td><?= htmlspecialchars($m->type) ?></td>
          <td>
            <?php if (!empty($m->color)): ?>
              <?php
                $color = $m->color;
                $isHex = preg_match('/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/', $color);
              ?>
              <?php if ($isHex): ?>
                <?php
                  $textColor = (in_array(strtolower($color), ['#000','#000000','#111','#222'])) ? '#fff' : '#000';
                ?>
                <span class="badge" style="background-color: <?= htmlspecialchars($color) ?>; color: <?= $textColor ?>;">
                  <?= htmlspecialchars($color) ?>
                </span>
              <?php else: ?>
                <?= htmlspecialchars($color) ?>
              <?php endif; ?>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </td>
          <td>
            <?= '$' . number_format($m->price_per_gram, 4) ?>
          </td>
          <td><?= htmlspecialchars($m->stock_quantity) ?></td>
          <td>
            <?php if ($m->status === 'active'): ?>
              <span class="badge bg-success">Active</span>
            <?php else: ?>
              <span class="badge bg-secondary">Inactive</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($m->created_at ?? '') ?></td>
          <td>
            <a href="MaterialForm.php?id=<?= $m->id ?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <a href="MaterialDelete.php?id=<?= $m->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this material?');">
              <i class="fa-solid fa-trash"></i> Delete
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center text-muted py-3">No materials found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
