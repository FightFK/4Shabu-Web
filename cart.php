<?php
session_start();
require_once 'config/db.php';

if(!isset($_SESSION['user_login'])){
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
    header('location:login.php');
    exit; // เพิ่ม exit เพื่อหยุดการทำงานของสคริปต์ในกรณีที่ไม่มี session
}

// Get user_id from session
$user_id = $_SESSION['user_login'];
//Product ID
$productIds = [];
foreach(($_SESSION['cart']??[]) as $cartId => $cartQty){
    $productIds[]=$cartId;
}

$ids =0;
if(count($productIds)>0){
    $ids = implode(',',$productIds);
}


//ดึงข้อมูลจากตาราง Product มาแสดง
$sql = "SELECT * FROM product WHERE id IN ($ids)";
$stmt = $conn->query($sql);
$rows = $stmt->rowCount();
// Product Select Edit

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="order.css">
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
          <li class="nav-item ">
              <a class="nav-link ms-3" href="cart.php">Cart(<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
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

  <h4 class="text-center mt-4">Cart</h4>
 
  <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>


        <div class="row mx-auto " style="width:80%">
            <div class="col-12">
                <form>
            <table class="table table-bordered border-info ">
            <thead>
                <tr>
                    <th style="width: 150px;">Image</th>
                    <th style="width:200px">Product Name</th>
                    <th style="width: 150px;">Price</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 200px;">Total</th>
                   

                    <th style="width: 120px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows > 0): ?>
                    <?php while ($product = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td>
                                <?php if (!empty($product['profile_image'])): ?>
                                    <img src="upload_image/<?php echo $product['profile_image'] ?>" width="100" alt="Product Image">
                                <?php else: ?>
                                    <img src="img/Null" width="100" alt="Product Image"/>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo number_format($product['price'], 2); ?></td>
                            <td><input type="number" name="" value="<?php echo $_SESSION['cart'][$product['id']];?>" class="form-control"></td>
                            <td>
                                <?php echo number_format($product['price']*$_SESSION['cart'][$product['id']], 2);
                                ?>
                            </td>
                            <td>
                               
                                <a href="delete_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan ="6" class="text-end">
    
                            <a href="checkout.php" class="btn btn-lg btn-primary">Checkout</a>
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6"><h3 class="text-center text-danger">Not Found</h3></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
            </div>
        </div>


</body>

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
