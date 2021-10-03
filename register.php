<?php
function inputfields($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include "captcha.php";
$name_error = $age_error = $gen_error = $mail_error = $pass_error = $conpass_error = $pic_error = $cap_error = $output = '';

if (isset($_POST['reg'])) {
    $name = inputfields($_POST['name']);
    $age = inputfields($_POST['age']);
    $gen = @$_POST['gen'];
    $mail = inputfields($_POST['mail']);
    $pass = inputfields($_POST['pass']);
    $conpass = inputfields($_POST['conpass']);
    $tmp = $_FILES['pic']['tmp_name'];
    $pic = $_FILES['pic']['name'];
    $cap = inputfields($_POST['cap']);
    $checkcap = inputfields($_POST['checkcap']);

    if (empty($name)) {
        $name_error = "Please enter name";
    } else {
        if (!preg_match("/^[a-zA-Z ]{2,100}$/", $name)) {
            $name_error = "Enter valid format";
        }
    }

    if (empty($gen)) {
        $gen_error = "Select gender";
    }

    if (empty($age)) {
        $age_error = "Please enter age";
    } else {
        if (!($age >= 1 && $age <= 100)) {
            $age_error = "Enter valid age";
        }
    }

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

    if (empty($conpass)) {
        $conpass_error = "Please re-enter password";
    } else {
        if ($conpass != $pass) {
            $conpass_error = "Password doesn't match";
        }
    }

    if (empty($tmp)) {
        $pic_error = "Upload a picture";
    } else {
        $ext = pathinfo($pic, PATHINFO_EXTENSION);
        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
            $pic_error = "";
        } else {
            $pic_error = "Invalid format. Only jpg, jpeg and png formats allowed";
        }
    }

    if (empty($cap)) {
        $cap_error = "Enter captcha";
    }

    if ($name_error == "" && $age_error == "" && $gen_error == "" && $mail_error == "" && $pass_error == "" && $conpass_error == "" && $cap_error == "" && $pic_error == "") {
        if ($cap == $checkcap) {
            $dest = 'users/' . $mail;
            if (is_dir($dest)) {
                $output = "User already exists";
            } else {
                $img_source = $dest . "/" . $name . $age . time() . "." . $ext;
                mkdir($dest);
                if (move_uploaded_file($tmp, $img_source)) {
                    $pic_error =  "File uploaded";
                    $fo = fopen($dest . "/details.txt", "w");
                    $password = substr(sha1($pass), 0, 12);
                    echo fwrite($fo, "$password\n$name\n$age\n$gen\n$img_source\n$mail");
                    fclose($fo);
                } else {
                    $pic_error = "Error";
                }
                $output = "User registered successfully";
                session_start();
                $_SESSION['name'] = $name;
                header("Location:welcome.php");
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
    <title>Register New User</title>
</head>

<body>
    <div class="jumbotron jumbotron-fluid" style="background-image: url(images/regbg.jpeg); background-repeat: no-repeat; background-size: 100% 100%;">
        <div class="container">
            <h1 class="display-4">Welcome to Spark EduTech</h1>
            <p class="lead">Register and become a part of worlds most innovative group</p>
        </div>
    </div>
    <div class="container">
        <h2>New User Registration</h2>
        <hr />
        <form method="POST" enctype="multipart/form-data">
            <h5 style="color: green;"><?php echo "$output"; ?></h5>
            <div class="form-group row">
                <label for="name_id" class="col-sm-2 col-form-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name_id" name="name" placeholder="Name">
                    <span class="error"><?php echo "$name_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="mail_id" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="mail_id" name="mail" placeholder="Email">
                    <span class="error"><?php echo "$mail_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="age_id" class="col-sm-2 col-form-label">Age:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="age_id" name="age" placeholder="Age">
                    <span class="error"><?php echo "$age_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="gen" class="col-sm-2 col-form-label">Gender:</label>
                <div class="col-sm-10">
                    <input type="radio" name="gen" value="Male">&nbsp;Male&nbsp;
                    <input type="radio" name="gen" value="Female">&nbsp;Female&nbsp;
                    <input type="radio" name="gen" value="Other">&nbsp;Other&nbsp;
                    <span class="error"><?php echo "$gen_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Profile Picture:</label>
                <div class="col-sm-10">
                    <input type="file" name="pic">
                    <span class="error"><?php echo "$pic_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="pass_id" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="pass_id" name="pass" placeholder="Password">
                    <span class="error"><?php echo "$pass_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="conpass_id" class="col-sm-2 col-form-label">Confirm Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="conpass_id" name="conpass" placeholder="Password">
                    <span class="error"><?php echo "$conpass_error"; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="cap" class="col-sm-2 col-form-label">Captcha:</label>
                <div class="col-sm-10">
                    <h5 class="text-primary"><?php echo "$captcha"; ?></h5>
                    <input type="text" class="form-control" name="checkcap" value="<?php echo "$capval"; ?>" hidden>
                    <input type="text" class="form-control" name="cap" placeholder="Captcha Answer">
                    <span class="error"><?php echo "$cap_error"; ?></span>
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-large" name="reg" value="Register">
            <a href="index.php" class="pull-right btn btn-default">Login</a>
        </form>
    </div>


    <?php include "footer.php"; ?>
    <?php include "foot.php"; ?>
</body>

</html>