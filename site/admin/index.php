<?php
require_once __DIR__ . '/database/db.class.php';
include __DIR__ . '/header.php';
?>
<div class="px-3">
  <h1 class="h3 mb-4">Admin Dashboard</h1>
  <div class="list-group">
    <a href="user/UserList.php" class="list-group-item list-group-item-action">Manage Users</a>
    <a href="category/CategoryList.php" class="list-group-item list-group-item-action">Manage Categories</a>
    <a href="product/ProductList.php" class="list-group-item list-group-item-action">Manage Products</a>
    <a href="order/OrderList.php" class="list-group-item list-group-item-action">Manage Orders</a>
  </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>