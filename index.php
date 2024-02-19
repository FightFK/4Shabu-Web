<?php
    session_start();
    require_once 'config/db.php';
    if(!isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
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
</header>

    <section id="main-content">
    <div>
        <h1 >
            PROMOTION FOR TODAY!!!
        </h1>
        <div id="carouselExample" class="carousel slide" data-ride="carousel" >
            <center><div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="promo1.png" class="d-block" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="promo2.png" class="d-block" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="promo3.png" class="d-block" alt="Slide 3">
                </div>
                <div class="carousel-item">
                    <img src="promo4.png" class="d-block" alt="Slide 4">
                </div></center>
            </div>

            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </section>




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
