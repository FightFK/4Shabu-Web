<?php
    session_start();
    require_once 'config/db.php';
    $title="Admin-Home";
    require_once 'layout/header.php';
    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/fontawesome/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="assets/fontawesome/css/brands.min.css"/>
    <link rel="stylesheet" href="assets/fontawesome/css/solid.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<!-- ส่วนของแถบเมนู -->
<?php 
        if (isset($_SESSION['admin_login'])) {
             $user_id = $_SESSION['admin_login'];
             $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <img src="./img/logo.png" style="width:80px">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-bars-progress me-1" ></i>4Shabu Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="table.php">จัดการโต๊ะ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">จัดการ Order</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hello, <?php echo $row['username']?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="member.php"><i class="fa-regular fa-user me-2"></i>จัดการสมาชิก</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item bg-danger text-light"  href="logout.php">Logout</a></li>
                    </ul>
                </li>     
            </ul>
        </div>
    </div>
</nav>