    <?php
        session_start();
        require_once 'config/db.php';
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="login-container">
            <div class ="logo"><img src="logo.png"></div>
            <hr>
            <h2>Login</h2>
            <hr>
            <form action="login_db.php" method="post">
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
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="signin" class="btn btn-success">Login</button>
            </form>
            <br>
            <div class="signup-link">
                <p>Don't have an account? <a href="register.php" style="text-decoration: underline;
    ">Sign up</a></p>
            </div>
        </div>
    </body>
    </html>

