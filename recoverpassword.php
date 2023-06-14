<?php
include "db.php";
SESSION_START();

$message = "";
$inter = $_SESSION['phone'];

$luke = "SELECT * FROM login where id = '$inter'";
$lake = mysqli_query($db, $luke);
$luck = mysqli_fetch_array($lake);

if(isset($_POST['request'])){
    $verify = "1234567890";
    $verify_1 = str_shuffle($verify);
    $verify_2 = substr($verify_1, 0, 4);

    $counter = "UPDATE login SET code = '$verify_2' WHERE id ='$inter'";
    $otp = mysqli_query($db, $counter);
    if($otp){
        header('location:resetpassword.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumia signup dub</title>
    <link rel="shortcut icon" href="images/Jumia-Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style/signup.css">
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/recoverpassword.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/brands.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/brands.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/regular.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/solid.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/solid.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/svg-with-js.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/svg-with-js.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v4-font-face.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v4-font-face.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v4-shims.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v4-shims.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v5-font-face.css">
    <link rel="stylesheet" href="fontawesome/fontawesome-free-6.1.1-web/css/v5-font-face.min.css">

</head>
<body>
    <div class="container">
        <form action="" method="post">
        <div class="logo"><img src="images/one_logo.png" alt="">
        <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <div class="first">
            <h2>Recover your password</h2>
            <p>You can request a password reset below. We will send a security code to the email address, please make sure
                it is correct.
            </p>
        </div>
        <div class="grey"><p><?php echo $luck['phone'] ; ?></p><p class="orange">Edit</p></div>
        <button class="continue" name="request">Request password reset</button>
        <div class="support"><p>For further support, you may visit the Help Center or contact our customer service team</p></div>
        <div class="lastlogo"><img src="images/Jumia-Logo.png" alt=""></div>
        </form>
    </div>

</body>
</html>