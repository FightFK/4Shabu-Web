<?php
require_once 'config/db.php';

if(isset($_POST['table_id'])) {
    $table_id = $_POST['table_id'];

    try {
        // ตรวจสอบว่าโต๊ะที่เลือกมีการจองหรือไม่
        $check_query = "SELECT * FROM tbl_booking WHERE table_id = :table_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':table_id', $table_id);
        $check_stmt->execute();
        $booking_exists = $check_stmt->rowCount();

        if($booking_exists) {
            // ถ้ามีการจอง ให้ทำการลบการจองโต๊ะในตาราง tbl_booking
            $delete_query = "DELETE FROM tbl_booking WHERE table_id = :table_id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':table_id', $table_id);
            $delete_stmt->execute();

            // อัปเดตสถานะโต๊ะในตาราง tbl_table เป็นสถานะไม่ถูกจอง
            $update_query = "UPDATE tbl_table SET table_status = 0 WHERE id = :table_id";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(':table_id', $table_id);
            $update_stmt->execute();

            $_SESSION['success'] = "ลบการจองโต๊ะเรียบร้อยแล้ว";
        } else {
            $_SESSION['error'] = "ไม่สามารถลบโต๊ะที่ว่างได้ เนื่องจากไม่มีการจองโต๊ะนี้";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
} else {
    $_SESSION['error'] = "กรุณาเลือกโต๊ะที่ต้องการลบการจอง";
}

header('Location: table.php');
exit;
?>
