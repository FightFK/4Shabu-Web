<?php
require_once 'config/db.php'; // เชื่อมต่อกับฐานข้อมูล
require_once 'config/controller.php'; // เรียกใช้ Controller

$controller = new Controller($conn); // สร้างอ็อบเจกต์ Controller โดยใช้การเชื่อมต่อฐานข้อมูลที่กำหนดไว้ในไฟล์ db.php

if(!isset($_GET["id"])){
    header("location:admin.php");
}else{
    $id = $_GET["id"];
    $result = $controller->delete($id);
    if($result){
        header("location:member.php");
    }
}

?>
