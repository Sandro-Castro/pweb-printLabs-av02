<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db      = new DB('categories');
$errors  = [];
$success = '';
$data    = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = (object) $_POST;
    if (empty(trim($_POST['name']))) {
        $errors[] = "Name is required";
    }
    if (empty($errors)) {
        try {
            if (empty($_POST['id'])) {
                $db->store($_POST);
                $success = "Category created successfully.";
            } else {
                $db->update($_POST);
                $success = "Category updated successfully.";
            }
            header("Refresh:1; url=CategoryList.php");
        } catch (Exception $e) {
            $errors[] = "Error saving category: " . $e->getMessage();
        }
    }
}

if (!empty($_GET['id'])) {
    $data = $db->find($_GET['id']);
}
?>
<div class="px-3">
  <div class="mb-3">
    <h2 class="h4"><?= !empty($_GET['id']) ? "Edit Category" : "New Category" ?></h2>
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
      <label class="form-label">Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($data->name ?? '') ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($data->description ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-success"><?= !empty($_GET['id']) ? "Update" : "Create" ?></button>
    <a href="CategoryList.php" class="btn btn-secondary ms-2">Back</a>
  </form>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
