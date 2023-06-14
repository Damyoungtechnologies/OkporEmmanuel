<?php
include 'db.php';
// include '../../component/error_message_header.php';  

$errormessage = "";

if(isset($_POST['code1'])){

$otpcode = $_POST['code1'];


if(empty($otpcode)){
    $errormessage ="the field is required";
}else{

    $data = "SELECT * FROM login WHERE code = '$otpcode' LIMIT 1";
    $data1 = mysqli_query($db, $data);
    $data1result = mysqli_fetch_array($data1);

    if($data1result['code'] === $otpcode){
        $errormessage ="verification successful";
        header('location:homepage.html');
        
    }else{
     
        $errormessage ="verification failed";
        

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



if( success == "verification successful"){

    
var name = document.getElementById('actualcode');


name.value ="";




}



</script>


 