<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../database/db.class.php';

$db = new DB('materials');
if (!empty($_GET['id'])) {
  
    $db->destroy($_GET['id']);
}
header("Location: MaterialList.php");
exit;
