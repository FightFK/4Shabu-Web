<?php
    require_once 'config/db.php';

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $product_id = $_GET['id'];

        // ดึงข้อมูลสินค้าที่ต้องการแก้ไขจากฐานข้อมูล
        $sql = "SELECT * FROM product WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$product) {
            $_SESSION['error'] = 'ไม่พบสินค้าที่ต้องการแก้ไข';
            header('Location: admin.php');
            exit;
        }

        // หากมีการส่งข้อมูลฟอร์มแก้ไข
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];

            // ทำการอัปเดตข้อมูลสินค้า
            $sql = "UPDATE product SET product_name = :product_name, price = :price WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $_SESSION['message'] = 'แก้ไขข้อมูลสินค้าเรียบร้อยแล้ว';
                header('Location: admin.php');
                exit;
            } else {
                $_SESSION['error'] = 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล';
            }
        }
    } else {
        $_SESSION['error'] = 'ไม่พบสินค้าที่ต้องการแก้ไข';
        header('Location: admin.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $product['product_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" id="price" name="price" class="form-control" value="<?php echo $product['price']; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>

