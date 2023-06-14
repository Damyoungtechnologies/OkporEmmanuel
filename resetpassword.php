<?php
include "db.php";
SESSION_START();

$message = "";
$inter = $_SESSION['phone'];



if(isset($_POST['request'])){
  $verify = "1234567890";
  $verify_1 = str_shuffle($verify);
  $verify_2 = substr($verify_1, 0, 4);

  $yoga = "SELECT * FROM login where id='$inter'";
  $yin = mysqli_query($db, $yoga);
  $yang = mysqli_fetch_array($yin);

  $messagebox = 'Dear customer,  Use this for your jumia authentication '.$verify_2.'. This is valid for 30 minutes.Do not share it with anyone.';

  //send message

$email = "okporemmanuel@gmail.com"; //your bulksmslive registered email
$password = "emmanuel1000"; //Your password
$message = $messagebox; //message content
$sender_name = "OKPORTECH"; //Your sender name
$recipients = $yang['phone']; //mobile numbers seperated by comma e.9 2348028828288,234900002000,234808887800
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
$counter = "UPDATE login SET code = '$verify_2' WHERE id ='$inter'";
$otp = mysqli_query($db, $counter);
if($otp){
    header('location:resetpassword.php');
}else{
//if it failes do this
  $res_array = json_decode($result);
  // print_r($res_array); 
  $message = "Wrong password, kindly check again";    

}
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
    <link rel="stylesheet" href="style/resetpassword.css">
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
<body style="overflow-Y: hidden;">
    <div class="container">
        <form action="" method="post">
        <div class="logo"><img src="images/one_logo.png" alt="">
        <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <div class="first">
            <h2>Security code to reset password</h2>
            <p>Insert the security code sent to your email in order to
                proceed with the password reset
            </p>
        </div>
        <div class="input">
            <input type="number" class="box1" maxlength="1" name="otp[]" id="input" disabled>
            <input type="number" class="box2" maxlength="1" name="otp[]" id="input" disabled>
            <input type="number" class="box3"  maxlength="1" name="otp[]" id="input" disabled>
            <input type="number" class="box4" maxlength="1" name="otp[]" id="input" disabled>
        </div>
        <input type="button" class="continue" name="submit" onclick="validateOTP()" id="submit" value="verify code">
        </form>

        <script src="ajaxjquery.js"></script>
 <script>

          

$(document).ready(function(){

var name = document.querySelector('.box1');
var dept = document.querySelector('.box2');
var phone = document.querySelector('.box3');
var jambregno = document.querySelector('.box4');
var submit = document.getElementById('submit');



submit.addEventListener('click', submitform);

jambregno.addEventListener("keyup", submitform);

function submitform(){
    
  // alert('i am working');


  var name1 = name.value;
  var  dept1 = dept.value;
  var  phone1 = phone.value;
  var jambregno1 = jambregno.value;

 
  var otpcode = name1.concat(dept1, phone1, jambregno1);
  
  var code1 = otpcode;

  $.ajax({
    url: "process.php",
    method: "POST",
    data: { code1:code1 },
    success: function(data){

        $("#displayoutput").html(data);
       
    }

  })

}

})

    

 </script>
        <form action="" method="post">
        <button class="orange or" name="request"><p>Request a new code</p></button>
        </form>
        <div class="errorback" id="displayoutput" style="transform: translateY(-50px); display: grid; place-items: center; text-align: center; color: rgb(167, 8, 8); font-size: 0.9rem;">
        <?php if(!empty($message)) { ?>
        <?php echo $message ; ?>
        <?php } ?> 
        </div>
        <div class="support"><p>For further support, you may visit the Help Center or contact our customer service team</p></div>
        <div class="lastlogo"><img src="images/Jumia-Logo.png" alt=""></div>
        
    </div>
    <div class="contain" style="width: 100%; height: 100vh; background: rgba(128, 128, 128, 0.95); position: absolute; display: grid; place-items: center; display: none;">
    <div class="container pop" style=" background: orange; width 100%; max-width: 200px; max-height: 9rem; display: grid; place-items: center; ">
      <p>Here is your password</p>
      <span class="pass" style="width: 80%; height: 2rem; background: white;"></span>
      <p style="background: red; color: white; padding: 0.8rem"><a href="login.php" style="text-decoration: none;">Login</a></p>
    </div>
    </div>
    

 


    <script>
        //Initial references
    const input = document.querySelectorAll("#input");
    const inputField = document.querySelector(".input");
    const submitButton = document.getElementById("submit");
    let inputCount = 0,
     finalInput = "";

    //Update input
    const updateInputConfig = (element, disabledStatus) => {
    element.disabled = disabledStatus;
    if (!disabledStatus) {
      element.focus();
     } else {
       element.blur();
     }
    };

    input.forEach((element) => {
     element.addEventListener("keyup", (e) => {
      e.target.value = e.target.value.replace(/[^0-9]/g, "");
       let { value } = e.target;

       if (value.length == 1) {
          updateInputConfig(e.target, true);
         if (inputCount <= 3 && e.key != "Backspace") {
          finalInput += value;
          if (inputCount < 3) {
             updateInputConfig(e.target.nextElementSibling, false);
           }
         }
         inputCount += 1;
       } else if (value.length == 0 && e.key == "Backspace") {
         finalInput = finalInput.substring(0, finalInput.length - 1);
         if (inputCount == 0) {
          updateInputConfig(e.target, false);
           return false;
        }
         updateInputConfig(e.target, true);
         e.target.previousElementSibling.value = "";
         updateInputConfig(e.target.previousElementSibling, false);
         inputCount -= 1;
       } else if (value.length > 1) {
         e.target.value = value.split("")[0];
       }
       submitButton.classList.add("hide");
      });
    });

    window.addEventListener("keyup", (e) => {
      if (inputCount > 3) {
        submitButton.classList.remove("hide");
        submitButton.classList.add("show");
        if (e.key == "Backspace") {
          finalInput = finalInput.substring(0, finalInput.length - 1);
          updateInputConfig(inputField.lastElementChild, false);
          inputField.lastElementChild.value = "";
          inputCount -= 1;
          submitButton.classList.add("hide");
        }
      }
    });

    // const validateOTP = () => {
    //  alert("Success");
    // };

    //Start
    const startInput = () => {
      inputCount = 0;
      finalInput = "";
      input.forEach((element) => {
        element.value = "";
      });
     updateInputConfig(inputField.firstElementChild, false);
    };

    window.onload = startInput();
    </script>
    
</body>
</html>