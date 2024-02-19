<?php
    session_start();
    require_once 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="signup-container">
                    <div class="logo text-center">
                        <img src="logo.png" alt="Logo">
                    </div>
                    <hr>
                    <h2 class="text-center">Sign Up</h2>
                    <hr>
                    <form action="register_db.php" id="registerForm" method="post">
                        <?php if(isset($_SESSION['error'])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php 
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['success'])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['success'];
                                    unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['warning'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <?php 
                                    echo $_SESSION['warning'];
                                    unset($_SESSION['warning']);
                                ?>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password:</label>
                            <input type="password" id="confirm-password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name= "signup" class="btn btn-success">Sign Up</button>
                        </div>
                    </form>
                    <br>
                    <div class="text-center">
                        <p>Already have an account? <a href="login.php" style="text-decoration: underline;">Log in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




