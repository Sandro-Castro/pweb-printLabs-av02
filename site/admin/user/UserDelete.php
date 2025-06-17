<?php
require_once __DIR__ . '/../database/db.class.php';
$db = new DB('users');
if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}
header("Location: UserList.php");
exit;
