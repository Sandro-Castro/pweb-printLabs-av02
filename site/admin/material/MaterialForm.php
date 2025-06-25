<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$db = new DB('materials');

$errors = [];
$success = '';
$data = null;

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
    if (!$data) {
        echo '<div class="px-3"><div class="alert alert-danger">Material not found.</div></div>';
        include __DIR__ . '/../footer.php';
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = (object) $_POST;

    if (empty(trim($_POST['name'] ?? ''))) {
        $errors[] = "Name is required.";
    }

    $type = trim($_POST['type'] ?? '');
    if ($type === '') {
        $errors[] = "Type is required.";
    }
    
    if (!isset($_POST['price_per_gram']) || $_POST['price_per_gram'] === '') {
        $errors[] = "Price per gram is required.";
    } elseif (!is_numeric($_POST['price_per_gram']) || floatval($_POST['price_per_gram']) < 0) {
        $errors[] = "Price per gram must be a non-negative number.";
    }

    
    if (!isset($_POST['stock_quantity']) || $_POST['stock_quantity'] === '') {
        $errors[] = "Stock quantity is required.";
    } elseif (!ctype_digit(strval($_POST['stock_quantity'])) || intval($_POST['stock_quantity']) < 0) {
        $errors[] = "Stock quantity must be a non-negative integer.";
    }

    
    $status = $_POST['status'] ?? '';
    if (!in_array($status, ['active','inactive'], true)) {
        $errors[] = "Invalid status selected.";
    }

    
    if (empty($errors)) {
        $color = trim($_POST['color'] ?? '');

        $record = [
            'name' => trim($_POST['name']),
            'description' => trim($_POST['description'] ?? ''),
            'type' => $type,
            'color' => $color !== '' ? $color : null,
            'price_per_gram' => number_format(floatval($_POST['price_per_gram']), 4, '.', ''),
            'stock_quantity' => intval($_POST['stock_quantity']),
            'status' => $status
        ];

        try {
            if (empty($_POST['id'])) {
                
                $db->store($record);
                $success = "Material created successfully.";
            } else {
                
                $record['id'] = $_POST['id'];
                $db->update($record);
                $success = "Material updated successfully.";
            }
            header("Refresh:1; url=MaterialList.php");
        } catch (Exception $e) {
            $errors[] = "Error saving material: " . $e->getMessage();
        }
    }
}


?>
<div class="px-3">
  <div class="mb-3">
    <h2 class="h4">
      <?php if (!empty($_GET['id'])): ?>
        <i class="fa-solid fa-pen-to-square"></i> Edit Material
      <?php else: ?>
        <i class="fa-solid fa-plus"></i> New Material
      <?php endif; ?>
    </h2>
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
      <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
      <input type="text" id="name" name="name"
             value="<?= htmlspecialchars($data->name ?? '') ?>"
             class="form-control" required>
      <div class="invalid-feedback">Please enter the material name.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="description">Description</label>
      <textarea id="description" name="description" class="form-control" rows="3"><?= htmlspecialchars($data->description ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label" for="type">Type <span class="text-danger">*</span></label>
      <input type="text" id="type" name="type"
             value="<?= htmlspecialchars($data->type ?? '') ?>"
             class="form-control" placeholder="e.g., PLA, ABS, PETG" required>
      <div class="invalid-feedback">Please specify the material type.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="color">Color</label>
      <input type="text" id="color" name="color"
             value="<?= htmlspecialchars($data->color ?? '') ?>"
             class="form-control" placeholder="#rrggbb or name">
      <div class="form-text">Optional: hex code (#rrggbb) or color name.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="price_per_gram">Price per Gram <span class="text-danger">*</span></label>
      <input type="number" id="price_per_gram" name="price_per_gram"
             step="0.0001" min="0" 
             value="<?= htmlspecialchars($data->price_per_gram ?? '') ?>"
             class="form-control" required>
      <div class="invalid-feedback">Please enter a non-negative price per gram.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="stock_quantity">Stock Quantity <span class="text-danger">*</span></label>
      <input type="number" id="stock_quantity" name="stock_quantity"
             step="1" min="0"
             value="<?= htmlspecialchars($data->stock_quantity ?? '') ?>"
             class="form-control" required>
      <div class="invalid-feedback">Please enter a non-negative stock quantity.</div>
    </div>

    <div class="mb-3">
      <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
      <select id="status" name="status" class="form-select" required>
        <option value="" disabled <?= !isset($data->status) ? 'selected' : '' ?>>-- Select Status --</option>
        <option value="active" <?= (isset($data->status) && $data->status==='active') ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= (isset($data->status) && $data->status==='inactive') ? 'selected' : '' ?>>Inactive</option>
      </select>
      <div class="invalid-feedback">Please select a status.</div>
    </div>

    <div class="mb-3">
      <button type="submit" class="btn btn-success">
        <?php if (!empty($_GET['id'])): ?>
          <i class="fa-solid fa-pen-to-square"></i> Update
        <?php else: ?>
          <i class="fa-solid fa-plus"></i> Create
        <?php endif; ?>
      </button>
      <a href="MaterialList.php" class="btn btn-secondary ms-2">
        <i class="fa-solid fa-arrow-left-long"></i> Back
      </a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/../footer.php'; ?>


