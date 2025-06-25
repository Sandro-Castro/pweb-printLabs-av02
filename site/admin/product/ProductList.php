<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$dbProducts = new DB('products');
$pdo = $dbProducts->getConnection();


$searchField = $_GET['field'] ?? '';
$searchValue = trim($_GET['search'] ?? '');


$allowedFields = [
    'name'           => 'p.name LIKE ?',        
    'category_id'    => 'p.category_id = ?',     
    'category_name'  => 'c.name LIKE ?',         
];

$whereSql = '';
$params = [];
if (!empty($searchField) && $searchValue !== '' && array_key_exists($searchField, $allowedFields)) {
    $clauseTemplate = $allowedFields[$searchField];
    if ($searchField === 'category_id') {
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
    p.id,
    p.name,
    p.price,
    p.category_id,
    c.name AS category_name,
    p.image,
    p.created_at
FROM products p
JOIN categories c ON p.category_id = c.id
{$whereSql}
ORDER BY p.created_at DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Products</h2>
    <a href="ProductForm.php" class="btn btn-success"><i class="fa-solid fa-plus"></i> New Product</a>
  </div>

  <form method="GET" class="mb-3">
    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="name" <?= $searchField === 'name' ? 'selected' : '' ?>>Name</option>
          <option value="category_id" <?= $searchField === 'category_id' ? 'selected' : '' ?>>Category ID</option>
          <option value="category_name" <?= $searchField === 'category_name' ? 'selected' : '' ?>>Category Name</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="search" class="form-control"
               placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
        <a href="ProductList.php" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i> Reset</a>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
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
          <td><?= htmlspecialchars($p->category_name) ?></td>
          <td>
            <?php if (!empty($p->image)): ?>
              <img src="/pweb-printLabs-av02/site/assets/IMG/products/<?= htmlspecialchars($p->image) ?>"
                   alt="<?= htmlspecialchars($p->name) ?>"
                   style="width: 50px; height:50px; object-fit:cover;">
            <?php else: ?>
              <span class="text-muted">No Image</span>
            <?php endif; ?>
          </td>
          <td><?= htmlspecialchars($p->created_at ?? '') ?></td>
          <td>
            <a href="ProductForm.php?id=<?= $p->id ?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <a href="ProductDelete.php?id=<?= $p->id ?>" class="btn btn-sm btn-outline-danger ms-1"
               onclick="return confirm('Delete this product?');">
              <i class="fa-solid fa-trash"></i> Delete
            </a>
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
