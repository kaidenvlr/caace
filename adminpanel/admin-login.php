<?php
    session_start();
    $username= !empty($_SESSION['username'])?$_SESSION['username']:'';
    if(!empty($username))
    {
        header("location:dashboard.php");
    }

    include('../db/dbConnect.php');
    include('./script/logpass-validation.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Admin Panel</title>
</head>
<body>
    <form class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Login</h1>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php echo $set_username; ?>">
            <p class="err-msg">
                <?php
                    if ($usernameErr!=1) {
                        echo $usernameErr;
                    }
                ?>
            </p>
        </div>
        <div class="form-group">
            <input type="password" class="form-control"  placeholder="Enter Password" name="password">
            <p class="err-msg">
                <?php
                    if($passErr!=1) {
                        echo $passErr;
                    } 
                ?>
            </p>
        </div>
        <button type="submit" class="button" name="login">Login</button>
    </form>
</body>
</html>