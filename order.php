<?php
session_start();
require_once 'config/db.php';

if(!isset($_SESSION['user_login'])){
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location:login.php');
    exit; // เพิ่ม exit เพื่อหยุดการทำงานของสคริปต์ในกรณีที่ไม่มี session
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="order.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    
<body>
   <!-- navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand me-auto" href="#">
        <img class="logo" src="logo.png" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Setting
            </a>
            <ul class="dropdown-menu ">
              <li><a class="dropdown-item" href="#">Account</a></li>
              <li><a class="dropdown-item btn btn-danger" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- navbar -->


    <p class="fs-1" id="menu">MENU</p>

    <form action="order_process.php" method="post">
        <div class="row row-cols-1 row-cols-md-3 g-4 container" id="pattern">
            <div class="col" >
                <div class="card h-100" >
                    <img src="promo4.png" class="card-img-top"  alt="ชุดอิ่มรัก">
                    <div class="card-body">
                        <h5 class="card-title">ชุดอิ่มรัก ราคา 199 บาท</h5>
                        <p class="card-text">สามชั้นสไลด์ สันคอสไลด์ และชุดผัก</p>
                        <label for="set1_quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set1_quantity" name="set1_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="promo1.png" class="card-img-top" alt="ชุดอิ่มใจ">
                    <div class="card-body">
                        <h5 class="card-title">ชุดอิ่มใจ ราคา 249 บาท </h5>
                        <p class="card-text">สามชั้นสไลด์ สันคอสไลด์ เบคอน หมูเด้ง และไข่ไก่</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set2_quantity" name="set2_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="promo3.png" class="card-img-top" alt="ชุดเติมรัก">
                    <div class="card-body">
                        <h5 class="card-title">ชุดเติมรัก ราคา 399 บาท </h5>
                        <p class="card-text">เนื้อริบอาบสไลด์ เนื้อใบพายสไลด์ สามชั้นสไลด์ สันคอสไลด์</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set2_quantity" name="set3_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="promo3.png" class="card-img-top" alt="ชุดเติมรัก">
                    <div class="card-body">
                        <h5 class="card-title">ชุดเติมรัก ราคา 399 บาท </h5>
                        <p class="card-text">เนื้อริบอาบสไลด์ เนื้อใบพายสไลด์ สามชั้นสไลด์ สันคอสไลด์</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set3_quantity" name="set3_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu4.png" class="card-img-top" alt="ชุดฉ่ำใจ">
                    <div class="card-body">
                        <h5 class="card-title">ชุดฉ่ำใจ ราคา 599 บาท </h5>
                        <p class="card-text">เนื้อออสเตรเลีย สันคอและสามชั้นสไลด์ ชุดผักใหญ่ น้ำซุป</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set4_quantity" name="set4_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col" >
                <div class="card h-100" >
                    <img src="menu5.jpg" class="card-img-top"  alt="หมูนุ่มโรยงา">
                    <div class="card-body">
                        <h5 class="card-title">หมูนุ่มโรยงา ราคา 59 บาท</h5>
                        <p class="card-text">-</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set5_quantity" name="set5_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu6.jpg" class="card-img-top" alt="หมูนุ่ม">
                    <div class="card-body">
                        <h5 class="card-title">หมูนุ่ม ราคา 49 บาท</h5>
                        <p class="card-text">-</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set6_quantity" name="set6_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu7.jpg" class="card-img-top" alt="เนื้อวัว">
                    <div class="card-body">
                        <h5 class="card-title">เนื้อวัว ราคา 79 บาท</h5>
                        <p class="card-text">-</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set7_quantity" name="set7_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu8.jpg" class="card-img-top" alt="ชุดอุ่นใจ">
                    <div class="card-body">
                        <h5 class="card-title">ชุดอุ่นใจ ราคา 119 บาท</h5>
                        <p class="card-text">ชุดเริ่มต้น ชุดผัก สันนอกสไลด์ สามชั้นสไลด์ ลูกชิ้น</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set8_quantity" name="set8_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu9.jpg" class="card-img-top" alt="ชุดผักพิเศษ">
                    <div class="card-body">
                        <h5 class="card-title">ชุดผักพิเศษ ราคา 59 บาท</h5>
                        <p class="card-text">-</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set9_quantity" name="set9_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu10.jpg" class="card-img-top" alt="ชุดเนื้อสไลด์นำเข้า">
                    <div class="card-body">
                        <h5 class="card-title">ชุดเนื้อสไลด์นำเข้า ราคา 299 บาท</h5>
                        <p class="card-text">เนื้อออสเตรเลียสไลด์</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set10_quantity" name="set10_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu11.jpg" class="card-img-top" alt="ชุดผักเพื่อสุขภาพ">
                    <div class="card-body">
                        <h5 class="card-title">ชุดผักเพื่อสุขภาพ ราคา 219 บาท</h5>
                        <p class="card-text">ชุดผักใหญ่พิเศษ สายรักผัก</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set11_quantity" name="set11_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col" >
                <div class="card h-100" >
                    <img src="menu12.jpg" class="card-img-top"  alt="ข้าวผัดมันเนื้อ">
                    <div class="card-body">
                        <h5 class="card-title">ข้าวผัดมันเนื้อ ราคา 99 บาท</h5>
                        <p class="card-text">ข้าวนุ่ม เต็มไปด้วยรสชาติของมันเนื้อ หอม อร่อย ลงตัว</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set12_quantity" name="set12_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu13.jpg" class="card-img-top" alt="มาม่าต้มยำกุ้งน้ำข้น">
                    <div class="card-body">
                        <h5 class="card-title">มาม่าต้มยำกุ้งน้ำข้น ราคา 159 บาท</h5>
                        <p class="card-text">ความแซ่บของความเป็นต้มยำอย่างไทย มีกุ้งแม่น้ำตัวโตๆ</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set13_quantity" name="set13_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="menu14.jpg" class="card-img-top" alt="บะหมี่หยกหมูกรอบ">
                    <div class="card-body">
                        <h5 class="card-title">บะหมี่หยกหมูกรอบ 89 บาท </h5>
                        <p class="card-text">บะหมี่หยกและหมูกรอบ พร้อมน้ำราดสูตรลับ อร่อยแสงออกปาก</p>
                        <label for="quantity">เพิ่มจำนวนสินค้า (between 1 and 20):</label>
                        <input type="number" id="set14_quantity" name="set14_quantity" min="0" max="20"><br /><br />
                    </div>
                </div>
            </div>
        </div>
        
            <!-- ส่วนอื่น ๆ ของการแสดงผลข้อมูลได้แก่ set2, set3, ..., set14 -->
        </div>
        <div class="text-center" style="margin-top:300px"> 
            <input class="btn btn-primary btn-lg" type="submit" value="ยืนยันคำสั่งซื้อ">
        </div>
        
    </form>

    <!-- Footer -->
    <footer class="bg-dark py-5 mt-5">
        <div class="container text-light text-center">
          <p class="displa-5 mb-3">Hello world</p>
          <small class="text-white-50">&copy; Copy right by Bellza 555</small>
        </div>
    </footer>
    <!-- Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
