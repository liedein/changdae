<?php
// html/admin/auth_check.php
session_start();

// 세션에 admin_logged_in 키가 없거나 true가 아니면 로그인 페이지로 튕김
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /admin/login.php');
    exit;
}
?>
