<?php
session_start();

/**
 * define the number of ../ to get to the root folder
 */
define('ROOT_LEVEL', '');

/**
 * require the general functions file
 */
require(ROOT_LEVEL . 'include/functions.php');


// Unset $_SESSION['error'] after displaying the error message
if(isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}else if(isset($_SESSION['ban-error'])){
    $errorBanMessage = $_SESSION['ban-error'];
    unset($_SESSION['ban-error']);
}
// insertUser();
?>

<html>
<head>
    <link rel="stylesheet" href="provided-assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <script src="provided-assets/jquery-3.4.1.js"></script>
    <script src="provided-assets/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
                /*
                    username = user1
                    password = abcd1234
                */
            ?>
            <h1>Login</h1>
            <?php if(isset($errorMessage)): ?>
            <div class="alert alert-danger">
                <?= $errorMessage;?>
            </div>
            <?php elseif(isset($errorBanMessage)): ?>
            <div class="alert alert-danger">
                <?= $errorBanMessage;?>
            </div>
            <?php endif; ?>
            <form class="form" action="scripts/login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="login" class="btn btn-primary" <?=isset($errorBanMessage)?'disabled':''?>>
                </div>
            </form>
        </div>

    </div>
</div>

</body>


</html>