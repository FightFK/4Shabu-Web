<?php
    require_once 'config/db.php';
    $title="Member-Management";
    require_once 'layout/header.php';
    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
        header('location:login.php');
    }
    
?>
<h1 class="text-center" style="background-color: lightgreen">Member Management</h1>
    <table class="table table-warning table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // เชื่อมต่อฐานข้อมูล
        require_once 'config/db.php'; // แก้ไขตามที่ต้องการ

        // เรียกใช้งาน Controller
        require_once 'config/controller.php';
        $controller = new Controller($conn);

        // ดึงข้อมูลผู้ใช้งานทั้งหมด
        $users = $controller->getInfo();

        // แสดงผลข้อมูลในตาราง
        foreach ($users as $user) {
        ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['role']; ?></td>
                
                <td><a onclick="return confirm("คุณเเน่ใจแล้วใช่หรือไม่ที่จะลบข้อมูล")" class="btn btn-danger" href='delete.php?id=<?php echo $user['id']; ?>'>ลบข้อมูล</a>
                <a class="btn btn-warning" href='edit.php?id=<?php echo $user['id']; ?>'>แก้ไขข้อมูล</a>
</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
