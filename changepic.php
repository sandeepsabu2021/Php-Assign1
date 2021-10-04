<?php
$newpic_error = $output = "";
if (isset($_POST['cpic'])) {
    $tmp = $_FILES['newpic']['tmp_name'];
    $newpic = $_FILES['newpic']['name'];
    $pass = $_SESSION['password'];
    $name = $_SESSION['name'];
    $age = $_SESSION['age'];
    $gen = $_SESSION['gen'];
    $pic = $_SESSION['pic'];
    $mail = $_SESSION['mail'];

    if (empty($tmp)) {
        $newpic_error = "Upload a picture";
    } else {
        $ext = pathinfo($newpic, PATHINFO_EXTENSION);
        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
            $newpic_error = "";
        } else {
            $newpic_error = "Invalid format. Only jpg, jpeg and png formats allowed";
        }
    }

    if ($newpic_error == "") {
        $dest = 'users/' . $mail;
        $img_source = $pic;
        if (move_uploaded_file($tmp, $img_source)) {
            $newpic_error =  "File uploaded";
            $fo = fopen($dest . "/details.txt", "w");
            fwrite($fo, "$pass\n$name\n$age\n$gen\n$img_source\n$mail");
            fclose($fo);
            $output = "Profile picture changed successfully";
        } else {
            $newpic_error = "Error";
        }
    }
}
?>
<!doctype html>
<html>

<head>
    <?php include "head.php"; ?>
    <title>Change Profile Pic</title>
</head>

<body>
    <h4>Change Profile Picture</h4><hr/>
    <form class="my-3" method="POST" enctype="multipart/form-data">
        <h5 style="color: green;"><?php echo "$output"; ?></h5>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Select New Profile Picture:</label>
            <div class="col-sm-10">
                <input type="file" name="newpic">
                <span class="error"><?php echo "$newpic_error"; ?></span>
            </div>
        </div>
        <input type="submit" class="btn btn-primary btn-large" name="cpic" value="Upload">
    </form>

    <?php include "foot.php"; ?>
</body>

</html>