<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location: login.php');
    exit;
}

if (!empty($_GET['id'])) {
    // ถ้ายังไม่มีสินค้านี้ในตะกร้า กำหนดค่า = 1
    if (empty($_SESSION['cart'][$_GET['id']])) {
        $_SESSION['cart'][$_GET['id']] = 1;
    } else {
        // ถ้ามีแล้ว +1
        $_SESSION['cart'][$_GET['id']] += 1;
    }

    $_SESSION['message'] = 'Cart Add Successfully';
}
header('location: order.php');
?>
