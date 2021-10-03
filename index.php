<?php
function inputfields($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$mail_error = $pass_error = '';

if (isset($_POST['log'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];

    if (empty($mail)) {
        $mail_error = "Please enter email";
    } else {
        if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mail)) {
            $mail_error = "Invalid format";
        }
    }

    if (empty($pass)) {
        $pass_error = "Please enter password";
    } else {
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $pass)) {
            $pass_error = "Minimum eight characters, at least one uppercase letter, one lowercase letter and one number";
        }
    }

    if ($mail_error == "" && $pass_error == "") {

        $dest = 'users/' . $mail;
        if (is_dir($dest)) {
            $fo = fopen($dest . "/details.txt", "r");
            $checkpass = trim(fgets($fo));
            fclose($fo);
            $password = substr(sha1($pass), 0, 12);
            if ($checkpass == $password) {
                if (isset($_POST['rem'])) {
                    setcookie("email", $mail, time() + (86400 * 2));
                    setcookie("password", $pass, time() + (86400 * 2));
                }

                session_start();
                $_SESSION['mail'] = $mail;
                header("Location:dashboard.php");
            } else {
                $pass_error = "Incorrect password";
            }
        } else {
            $mail_error = "User doesn't exist";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>User Login</title>
    <script>
        function remember() {
            if ("<?php echo $_COOKIE['email'] ?>" != undefined) {
                if ("<?php echo $_COOKIE['email'] ?>" == document.getElementById("mail_id").value) {
                    document.getElementById("pass_id").value = "<?php echo $_COOKIE['password'] ?>"
                } else {
                    document.getElementById("pass_id").value = "";
                }

            }
        }
    </script>
</head>

<body>
    <div class="jumbotron jumbotron-fluid text-white" style="background-image: url(images/logbg.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="container">
            <h1 class="display-4">Welcome to Spark EduTech</h1>
            <p class="lead">We're happy to have you back!!!</p>
        </div>
    </div>
    <div class="container">
        <h2>User Login</h2>
        <hr />
        <form method="POST">
            <div class="form-group row">
                <label for="mail_id" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="mail_id" name="mail" placeholder="Email" onchange = "remember()">
                    <span class="error"><?php echo "$mail_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="pass_id" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pass_id" name="pass" placeholder="Password">
                    <span class="error"><?php echo "$pass_error"; ?></span>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remuser" name="rem">
                <label class="form-check-label" for="remuser">Remember Me</label>
            </div><br />
            <input type="submit" class="btn btn-primary btn-large" name="log" value="Login">
            <a href="register.php" class="pull-right btn btn-default">New User?</a>
        </form>
    </div>


    <?php include "footer.php"; ?>
    <?php include "foot.php"; ?>
</body>

</html>