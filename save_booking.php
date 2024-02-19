<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location: login.php');
    exit(); // ออกจากสคริปต์หลังจาก redirect เพื่อป้องกันการดำเนินการเพิ่มเติม
}

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $table_id = $_POST['table_id'];
    $booking_name = $_POST['booking_name'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $booking_phone = $_POST['booking_phone'];

    // เตรียมคำสั่ง SQL สำหรับเพิ่มข้อมูลการจอง
    $query = "INSERT INTO tbl_booking (table_id, booking_name, booking_date, booking_time, booking_phone) VALUES (:table_id, :booking_name, :booking_date, :booking_time, :booking_phone)";
    $stmt = $conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(':table_id', $table_id);
    $stmt->bindParam(':booking_name', $booking_name);
    $stmt->bindParam(':booking_date', $booking_date);
    $stmt->bindParam(':booking_time', $booking_time);
    $stmt->bindParam(':booking_phone', $booking_phone);

    // ทำการ execute คำสั่ง SQL
    if ($stmt->execute()) {
        // อัปเดตสถานะของโต๊ะในตาราง tbl_table เป็น 1
        $update_query = "UPDATE tbl_table SET table_status = 1 WHERE id = :table_id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':table_id', $table_id);
        $update_stmt->execute();

        // ถ้าสำเร็จให้ redirect กลับไปที่หน้า book.php
        header('location: book.php');
        exit(); // ออกจากสคริปต์หลังจาก redirect เพื่อป้องกันการดำเนินการเพิ่มเติม
    } else {
        // ถ้าไม่สำเร็จให้กำหนดข้อความผิดพลาดและ redirect กลับไปที่หน้า book.php
        $_SESSION['error'] = 'มีบางอย่างผิดพลาดในการบันทึกการจองโต๊ะ';
        header('location: book.php');
        exit(); // ออกจากสคริปต์หลังจาก redirect เพื่อป้องกันการดำเนินการเพิ่มเติม
    }
}
?>
