<?php
include "db.php";
SESSION_START();

$message = "";
$inter = $_SESSION['phone'];

$luke = "SELECT * FROM login where id = '$inter'";
$lake = mysqli_query($db, $luke);
$luck = mysqli_fetch_array($lake);

if(isset($_POST['login'])){
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $mark = "SELECT * FROM login WHERE id = '$inter'";
    $june = mysqli_query($db, $mark);
    $jane = mysqli_fetch_array($june);

    if($jane['password'] == $password){

        $verify = "1234567890";
        $verify_1 = str_shuffle($verify);
        $verify_2 = substr($verify_1, 0, 4);

        $messagebox = 'Dear customer,  Use this for your jumia authentication '.$verify_2.'. This is valid for 30 minutes.Do not share it with anyone.';
        $jane['phone'];
        //send message
    
      $email = "okporemmanuel@gmail.com"; //your bulksmslive registered email
      $password = "emmanuel1000"; //Your password
      $message = $messagebox; //message content
      $sender_name = "OKPORTECH"; //Your sender name
      $recipients = $jane['phone']; //mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800
      $forcednd = "1"; //set to 1 if you want DND numbers to 
    
      $data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$recipients,"forcednd"=>$forcednd);
      $data_string = json_encode($data);
      $ch = curl_init('https://api.bulksmslive.com/v2/app/sms');
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
      $result = curl_exec($ch);
      if($result){
    //if successfull  do this
        $tired = "UPDATE login SET code = $verify_2 WHERE id = '$inter'";
        $kwechiri = mysqli_query($db, $tired);
        $message = "OTP has been sent to your phone"; 
        header('location:resetpassword.php');
    }else{
     //if it failes do this
        $res_array = json_decode($result);
        // print_r($res_array); 
        $message = "Wrong password, kindly check again";    
      }
    }
}

if(isset($_POST['forget'])){
    header('location:recoverpassword.php');
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
        <div class="grey"><p><?php echo $luck['phone']; ?></p><p class="orange">Edit</p></div>
        <div class="input">
            <input type="password" name="password" id="password" placeholder="Password">
            <span class="icons" onclick="showy()"><span id="show"><i class="fa fa-eye" aria-hidden="true"></i></span><span id="hide"><i class="fa fa-eye-slash" aria-hidden="true"></i></span></span>
        </div>
        <div class="errorback" style="transform: translateY(-50px); display: grid; place-items: center; text-align: center; color: rgb(167, 8, 8); font-size: 0.9rem;">
        <?php if(!empty($message)) { ?>
        <?php echo $message ; ?>
        <?php } ?> 
        </div>
        <button class="continue" name="login">Login</button>
        <button class="orange or" name="forget"><p>Forgot your password?</p></button>
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