<?php
include 'db.php';
SESSION_START();
// include '../../component/error_message_header.php';  

$errormessage = "";


if(isset($_POST['code1'])){

$otpcode = $_POST['code1'];



if(empty($otpcode)){
        $errormessage ="Enter verification code";
}else{

    $data = "SELECT * FROM login WHERE code = '$otpcode' LIMIT 1";
    $data1 = mysqli_query($db, $data);
    $data1result = mysqli_fetch_array($data1);
    $inter = $data1result['id'];

    if($data1result['code'] === $otpcode){

        
        // header('location: signup.php');
        $luke = "UPDATE login SET code = '' WHERE id = '$inter'";
        $muke = mysqli_query($db, $luke);
        $errormessage = "Verification successful";

        

    }else{
     
        $errormessage ="Invalid code";
        

    }



}






}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>

<?php

if(!empty($errormessage)){

    echo $errormessage;
}

?>
<input type="hidden" id="successmessage" name="" value = "<?php echo $errormessage ; ?>">



<script>

var success = document.getElementById("successmessage").value;



if( success == "Verification successful"){


window.location.href = "homepage.html"; 





}



</script>


 