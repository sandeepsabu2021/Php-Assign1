<?php
    session_start();
    $name = $_SESSION['name'];
    if(empty($name)){
        header("location:register.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>Welcome Page</title>
</head>

<body>
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome <?php echo $name; ?></h1>
        <p class="lead">Thank you for registering with NeoSOFT Technologies.</p>
        <hr class="my-4">
        <p>Click on the button below to login</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="index.php" role="button">Login</a>
        </p>
    </div>

    <?php include "foot.php"; ?>
</body>

</html>