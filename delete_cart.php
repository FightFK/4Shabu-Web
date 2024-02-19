<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location: login.php');
    exit;
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
    $_SESSION['message'] = 'Cart Delete Successfully';
}

header('location: cart.php');
?>
