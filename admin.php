<?php
    require_once 'config/db.php';
    $title="Admin-Home";
    require_once 'layout/header.php';
    if(!isset($_SESSION['admin_login'])){
        $_SESSION['error'] = 'ไม่มีสิทธิ์การเข้าถึง';
        header('location:login.php');
    }

    //ดึงข้อมูลจากตาราง Product มาแสดง
    $sql = "SELECT * FROM product";
    $stmt = $conn->query($sql);
    $rows = $stmt->rowCount();

?>

<body class="bg-body-tertiary ">

<div class="container " style="margin-top:30px";>
<center>
<h1 class="alert alert-info" role="alert">Add Product</h1>
  </center>
</div>
<div class="row g-3 mb-3 justify-content-center ">
<div class="col-sm-6" >
<form action="product-form.php" method="post" enctype="multipart/form-data">
    <div class="row g-3 mb-3">
      <div class="col-sm-6">
        <label class="form-label">Food Name</label>
        <input type="text" name="product_name" class="form-control" value="">
      </div>
      <div class="col-sm-6">
        <label class="form-label">Price</label>
        <input type="text" name="price" class="form-control" value="">
      </div>
      <div class="col-sm-6">
        <label class="formFile" class="form-label">Image</label>
        <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg,image/jpeg">
      </div> 
    </div>
    <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

    <button class="btn btn-info me1" type="submit">Add<i class="fa-solid fa-file m"></i></button>
    <hr class="my-4">
  </form>
  </div>
  </div>
  <div class="row ms-5 me-5">
    <div class="col-12">
        <table class="table table-bordered border-info table-primary ">
            <thead>
                <tr>
                    <th style="width: 150px;">Image</th>
                    <th>Product Name</th>
                    <th style="width: 150px;">Price</th>
                    <th style="width: 200px;">Action</th>
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
                            <td>
                                <a href="admin.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-dark btn-sm me-2">
                                    <i class="fa-solid fa-file-pen"></i> Edit
                                </a>
                                <a href="admin.php?id=<?php echo $product['id']; ?>" class="btn btn-outline-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4"><h3 class="text-center text-danger">Not Found</h3></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>