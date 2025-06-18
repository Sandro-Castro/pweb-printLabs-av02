<?php
session_start();

if (empty($_SESSION['user_id']) || empty($_SESSION['role'])) {
    header('Location: /pweb-printLabs-av02/site/admin/login.php');
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header('Location: /pweb-printLabs-av02/site/admin/login.php');
    exit;
}

