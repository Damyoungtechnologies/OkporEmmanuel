<?php
include "db.php";
SESSION_START();

$message = "";
if(isset($_POST['continue'])){
    $identity = mysqli_real_escape_string($db, $_POST['identity']);
    $matthew = "SELECT * FROM login WHERE email = '$identity' OR phone = '$identity' LIMIT 1";
    $mark = mysqli_query($db, $matthew);
    $john = mysqli_fetch_array($mark);

    
    if($john){
        $_SESSION['phone'] = $john['id'];
        header('location:login.php');
    }else{
        $message = "Either the email or phone number entered in not valid";
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
        <div class="logo"><img src="images/one_logo.png" alt=""></div>
        <form action="" method="post">
        <div class="first">
            <h2>Welcome to Jumia</h2>
            <p>Type your e-mail or phone number to login or create a jumia account</p>
        </div>
        <div class="input">
            <input type="text" name="identity" id="" placeholder="Email or Mobile number*">
        </div>
        <div class="errorback" style="transform: translateY(-50px); display: grid; place-items: center; text-align: center; color: rgb(167, 8, 8); font-size: 0.9rem;">
        <?php if(!empty($message)) { ?>
        <?php echo $message ; ?>
        <?php } ?> 
        </div>
        <button class="continue" name="continue">Continue</button>
        <div class="continue fac"> <i class="fa fa-facebook-square" aria-hidden="true"></i> <p>Log in with Facebook</p></div>
        </form>
        <div class="support"><p>For further support, you may visit the Help Center or contact our customer service team</p></div>
        <div class="lastlogo"><img src="images/Jumia-Logo.png" alt=""></div>
    </div>
    
</body>
</html>