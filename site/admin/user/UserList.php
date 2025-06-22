<?php
require_once __DIR__ . '/../database/db.class.php';
require_once __DIR__ . '/../auth.php';
include __DIR__ . '/../header.php';

$db = new DB('users');

$searchField = $_GET['field'] ?? '';
$searchValue = $_GET['search'] ?? '';

if (!empty($searchField) && !empty($searchValue)) {
    $users = $db->search([
        'field' => $searchField,
        'value' => $searchValue
    ]);
} else {
    $users = $db->all();
}
?>

<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Users</h2>
    <a href="UserForm.php" class="btn btn-success">
      <i class="fa-solid fa-plus"></i> New User
    </a>
  </div>
  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-auto">
        <select name="field" class="form-select" required>
          <option value="" disabled <?= empty($searchField) ? 'selected' : '' ?>>Search by...</option>
          <option value="name" <?= $searchField === 'name' ? 'selected' : '' ?>>Name</option>
          <option value="username" <?= $searchField === 'username' ? 'selected' : '' ?>>Username</option>
          <option value="email" <?= $searchField === 'email' ? 'selected' : '' ?>>Email</option>
          <option value="role" <?= $searchField === 'role' ? 'selected' : '' ?>>Role</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="text" name="search" class="form-control" placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" required>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
        <a href="UserList.php" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i> Reset
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
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($users)): ?>
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u->id ?></td>
          <td><?= htmlspecialchars($u->name) ?></td>
          <td><?= htmlspecialchars($u->username) ?></td>
          <td><?= htmlspecialchars($u->email) ?></td>
          <td><?= htmlspecialchars($u->role) ?></td>
          <td><?= htmlspecialchars($u->created_at ?? '') ?></td>
          <td>
            <a href="UserForm.php?id=<?= $u->id ?>" class="btn btn-sm btn-outline-secondary">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>
            <a href="UserDelete.php?id=<?= $u->id ?>" class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Delete this user?');">
              <i class="fa-solid fa-trash"></i> Delete
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-muted py-3">No users found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
