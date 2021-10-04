<?php
session_start();
$mail = $_SESSION['mail'];
if (empty($mail)) {
    header("location:index.php");
}
$dest = 'users/' . $mail;
$fo = fopen($dest . "/details.txt", "r");
$pass = trim(fgets($fo));
$name = trim(fgets($fo));
$age = trim(fgets($fo));
$gen = trim(fgets($fo));
$pic = trim(fgets($fo));
$mail = trim(fgets($fo));

$_SESSION['password'] = $pass;
$_SESSION['name'] = $name;
$_SESSION['age'] = $age;
$_SESSION['gen'] = $gen;
$_SESSION['pic'] = $pic;
$_SESSION['mail'] = $mail;

?>


<!doctype html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>Dashboard</title>
    <style>
        .user_pic {
            border-radius: 50%;
            border: 1px solid black;
        }

        .change_btn:hover {
            color: blue;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php include "nav.php"; ?>
    <div class="row">
        <aside class="col-lg-3 col-md-4 col-sm-5">
            <?php include "sidebar.php"; ?>

        </aside>
        <aside class="col-lg-9 col-md-8 col-sm-7 p-3 mt-2">
            <?php
            switch (@$_GET['page']) {

                case 'home':
                    include("home.php");
                    break;

                case 'changepass':
                    include("changepass.php");
                    break;

                case 'changepic':
                    include("changepic.php");
                    break;

                default:
                    include("home.php");
                    break;
            }
            ?>

        </aside>
    </div>

    <?php include "footer.php"; ?>
    <?php include "foot.php"; ?>
</body>

</html>