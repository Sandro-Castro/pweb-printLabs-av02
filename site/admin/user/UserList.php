<?php
require_once __DIR__ . '/../database/db.class.php';
include __DIR__ . '/../header.php';

$db = new DB('users');
$users = $db->all();
?>
<div class="px-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4">Users</h2>
    <a href="UserForm.php" class="btn btn-primary">New User</a>
  </div>
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
            <a href="UserForm.php?id=<?= $u->id ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <a href="UserDelete.php?id=<?= $u->id ?>" class="btn btn-sm btn-outline-danger"
               onclick="return confirm('Delete this user?');">Delete</a>
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
