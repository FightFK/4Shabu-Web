<?php
    require_once 'config/db.php';
    $title="Edit Member";
    require_once 'layout/header.php';
    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
        header('location:login.php');
    }

    // เชื่อมต่อฐานข้อมูล
    require_once 'config/db.php'; // แก้ไขตามที่ต้องการ

    // เรียกใช้งาน Controller
    require_once 'config/controller.php';
    $controller = new Controller($conn);

    // ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
    if(isset($_GET['id'])) {
        $user_id = $_GET['id'];

        // ดึงข้อมูลผู้ใช้งานตาม id
        $user = $controller->getUserById($user_id);

        // ตรวจสอบว่ามีข้อมูลผู้ใช้งานหรือไม่
        if($user) {
            // ตรวจสอบว่ามีการกดปุ่ม Submit หรือไม่
            if(isset($_POST['submit'])) {
                // รับค่าที่แก้ไขมาจากฟอร์ม
                $new_username = $_POST['username'] ?? '';
                $new_email = $_POST['email'] ?? '';
                $new_role = $_POST['role'] ?? '';

                // ทำการอัปเดตข้อมูลผู้ใช้งาน
                $update_result = $controller->updateUser($user_id, $new_username, $new_email, $new_role);

                if($update_result) {
                    $_SESSION['success'] = 'อัปเดตข้อมูลสำเร็จ';
                    header('Location: index.php'); // ลิ้งค์กลับไปยังหน้าหลักหลังจากอัปเดตข้อมูลเรียบร้อย
                    exit();
                } else {
                    $_SESSION['error'] = 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล';
                }
            }
?>

<h1 class="text-center" style="background-color: lightblue">Edit Member</h1>
    <div class="container">
        <form method="post" action="">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($user['username']) ? $user['username'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">
            </div>
            <div class="form-group mb-2">
                <label for="role"><i class="fas fa-user-tag"></i> Role:</label>
                <input type="text" class="form-control" id="role" name="role" value="<?php echo isset($user['role']) ? $user['role'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Submit</button>
        </form>
    </div>

<?php
        } else {
            $_SESSION['error'] = 'ไม่พบข้อมูลผู้ใช้งาน';
            header('Location: index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'ไม่พบรหัสผู้ใช้งาน';
        header('Location: index.php');
        exit();
    }

?>
