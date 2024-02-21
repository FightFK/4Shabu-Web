<?php
require_once 'config/db.php';
$title = "Member-Management";
require_once 'layout/header.php';
if (!isset($_SESSION['admin_login'])) {
    $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
    header('location:login.php');
}

// Prepare SQL statement
$query = "SELECT * FROM tbl_table ORDER BY id ASC";
$stmt = $conn->prepare($query);

// Execute the statement
$stmt->execute();

// Fetch all rows as an associative array
$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h1 class="ms-5 mt-2">สถานะโต๊ะ</h1>
<hr>
<div class="row justify-content-center" style="margin-top: 50px;">
    <?php foreach ($tables as $table) : ?>
        <div class="col-2 col-md-2 col-sm-2" style="margin: 20px;">
            <?php if($table['table_status'] == 0) : // โต๊ะว่าง ?>
                <button class="btn btn-success btn-lg" disabled>
                    <i class="fas fa-chair"></i> <?= 'Table ' . $table['table_name']; // เพิ่มคำว่า "Table" นำหน้าชื่อโต๊ะ ?>
                </button>
            <?php else : // โต๊ะถูกจอง ?>
                <button class="btn btn-success btn-lg" disabled>
                    <i class="fas fa-chair"></i> <?= 'Table ' . $table['table_name']; // เพิ่มคำว่า "Table" นำหน้าชื่อโต๊ะ ?>
                    </button>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<hr>
<h1 style="margin-left:100px;">ลบการจองโต๊ะ</h1>
<form action="delete_booking.php" method="post">
    <div class="mb-3 row">
        <label for="table_id" class="col-sm-2 col-form-label" style="margin-left:100px;">เลือกโต๊ะ</label>
        <div class="col-sm-4">
            <select name="table_id" id="table_id" class="form-control">
                <option value="" selected disabled>กรุณาเลือกโต๊ะ</option>
                <?php foreach ($tables as $table) : ?>
                    <option value="<?= $table['id'] ?>"><i class="fas fa-chair"></i> <?= 'Table ' . $table['table_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-danger btn-lg" style="margin-left:1000px;">ลบการจองโต๊ะ</button>
</form>
