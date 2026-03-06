<?php
session_start();
// 관리자 로그인 세션이 없으면 로그인 페이지로 리다이렉트
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /admin/login.php');
    exit;
}
?>