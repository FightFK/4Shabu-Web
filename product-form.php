<?php
session_start();
require_once 'config/db.php';
if(!isset($_SESSION['admin_login'])){
    $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
    header('location:login.php');
}
$product_name = trim($_POST['product_name']);
$price = trim($_POST['price']);
$imgname = $_FILES['profile_image']['name'];
$detail = trim($_POST['detail']); // เพิ่มการรับค่า detail จากฟอร์ม

$image_tmp = $_FILES['profile_image']['tmp_name'];
$folder = "upload_image/";
$image_location = $folder . $imgname;

$sql = "INSERT INTO product (product_name, price, profile_image,detail) VALUES (:product_name, :price, :profile_image,:detail)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':product_name', $product_name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':detail', $detail);
$stmt->bindParam(':profile_image', $imgname);

if ($stmt->execute()) {
    // ทำงานเมื่อคำสั่ง SQL ถูก execute สำเร็จ
    $_SESSION['message'] = 'Food Saved';
    header('location: admin.php');
    exit;
} else {
    // ทำงานเมื่อคำสั่ง SQL  execute ไม่สำเร็จ
    $_SESSION['message'] = "Food Can't Saved";
    header('location: admin.php');
    exit;
}

?>