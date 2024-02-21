<?php
session_start();
require_once 'config/db.php';
if(!isset($_SESSION['user_login'])){
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location:login.php');
}

// Prepare SQL statement
$query = "SELECT * FROM tbl_table ORDER BY id ASC";
$stmt = $conn->prepare($query);

// Execute the statement
$stmt->execute();

// Fetch all rows as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Table</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="book.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="assets/fontawesome/css/brands.min.css"/>
    <link rel="stylesheet" href="assets/fontawesome/css/solid.min.css"/>
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand me-auto" href="#">
            <img class="logo" src="img/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="order.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book.php">Book a queue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="news.php">News</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Setting
                    </a>
                    <ul class="dropdown-menu ">
                        <li><a class="dropdown-item" href="#">Account</a></li>
                        <li><a class="dropdown-item bg-danger text-light" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- navbar -->


<div class="row justify-content-center card">
    <div class="col-sm-12 col-md-12 " >
        <div class="alert alert-warning" role="alert">
            <center><h1>Table Reserve</h1></center>
        </div>
        <hr>
        <div class="alert alert-primary  ">
            <div class="row justify-content-center" style="margin-top: 5px; margin-bottom-5px;" >
                <?php foreach ($result as $row) : ?>
                    <div class="col-2 col-md-2 col-sm-2" style="margin: 20px;">
                        <?php if($row['table_status'] == 0) : // โต๊ะว่าง ?>
                            <button class="btn btn-success btn-lg" disabled>
                            <i class="fas fa-chair"></i> <?= 'Table ' . $row['table_name']; // เพิ่มคำว่า "Table" นำหน้าชื่อโต๊ะ ?>
                            </button>
                        <?php else : // โต๊ะถูกจอง ?>
                            <button class="btn btn-danger disabled btn-lg">
                            <i class="fas fa-chair"></i> <?= 'Table ' . $row['table_name']; // เพิ่มคำว่า "Table" นำหน้าชื่อโต๊ะ ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">จองโต๊ะ</h5>
                <form action="save_booking.php" method="post">
                    <div class="mb-3">
                        <label for="table_id" class="form-label">เลือกโต๊ะ</label>
                        <select class="form-select" name="table_id" id="table_id" required>
                            <option value="" selected disabled>โปรดเลือกโต๊ะ</option>
                            <?php foreach ($result as $row) : ?>
                                <?php if ($row['table_status'] == 0) : ?>
                                    <option value="<?= $row['id'] ?>">โต๊ะ <?= $row['table_name'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="booking_name" class="form-label">ชื่อผู้จอง</label>
                        <input type="text" class="form-control" id="booking_name" name="booking_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">วันที่</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_time" class="form-label">เวลา</label>
                        <input type="time" class="form-control" id="booking_time" name="booking_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_phone" class="form-label">เบอร์โทร</label>
                        <input type="tel" class="form-control" id="booking_phone" name="booking_phone" required>
                    </div>
                    <button type="submit" class="btn btn-success">บันทึกการจอง</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark py-5 mt-5">
        <div class="container text-light text-center">
          <p class="displa-5 mb-3">Hello world</p>
          <small class="text-white-50">&copy; Copy right by Bellza 555</small>
        </div>
    </footer>
    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
