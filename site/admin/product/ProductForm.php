<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db         = new DB('products');
$dbCategory = new DB('categories');
$categories = $dbCategory->all();

$errors  = [];
$success = '';
$data    = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = (object) $_POST;
    
    if (empty(trim($_POST['name']))) {
        $errors[] = "Name is required";
    }
    if (!isset($_POST['price']) || !is_numeric($_POST['price'])) {
        $errors[] = "Valid price is required";
    }
    if (empty($_POST['category_id'])) {
        $errors[] = "Category is required";
    }
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmpName  = $_FILES['image']['tmp_name'];
        $origName = basename($_FILES['image']['name']);
        $ext      = pathinfo($origName, PATHINFO_EXTENSION);
        
        $newName  = uniqid('prod_') . "." . $ext;
        
        $dest = __DIR__ . '/../../public/assets/img/products/' . $newName;
        if (!is_dir(dirname($dest))) {
            mkdir(dirname($dest), 0755, true);
        }
        move_uploaded_file($tmpName, $dest);
        $_POST['image'] = $newName;
    } else {
        if (!empty($_POST['id'])) {
           
            $existing = $db->find($_POST['id']);
            $_POST['image'] = $existing->image;
        } else {
            $_POST['image'] = null;
        }
    }
    if (empty($errors)) {
        try {
            if (empty($_POST['id'])) {
                $db->store($_POST);
                $success = "Product created successfully.";
            } else {
                $db->update($_POST);
                $success = "Product updated successfully.";
            }
            header("Refresh:1; url=ProductList.php");
        } catch (Exception $e) {
            $errors[] = "Error saving product: " . $e->getMessage();
        }
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}
?>
<div class="px-3">
  <div class="mb-3">
    <h2 class="h4"><?= !empty($_GET['id']) ? "Edit Product" : "New Product" ?></h2>
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

  <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <input type="hidden" name="id" value="<?= htmlspecialchars($data->id ?? '') ?>">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($data->name ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data->description ?? '') ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($data->price ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select" required>
        <option value="">-- Select Category --</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat->id ?>"
            <?= (!empty($data) && $data->category_id == $cat->id) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat->name) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" accept="image/*" class="form-control">
      <?php if (!empty($data->image)): ?>
        <div class="mt-2">
          <img src="/assets/img/products/<?= htmlspecialchars($data->image) ?>" alt=""
               style="width:100px; height:100px; object-fit:cover; border:1px solid #ccc;">
        </div>
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success"><?= !empty($_GET['id']) ? "Update" : "Create" ?></button>
    <a href="ProductList.php" class="btn btn-secondary ms-2">Back</a>
  </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
