<?php
    require_once 'config/db.php';

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $product_id = $_GET['id'];

        // ลบข้อมูลสินค้า
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

        if($stmt->execute()) {
            $_SESSION['message'] = 'ลบข้อมูลสินค้าเรียบร้อยแล้ว';
        } else {
            $_SESSION['error'] = 'เกิดข้อผิดพลาดในการลบข้อมูลสินค้า';
        }
    } else {
        $_SESSION['error'] = 'ไม่พบสินค้าที่ต้องการลบ';
    }

    header('Location: admin.php');
    exit;
?>
