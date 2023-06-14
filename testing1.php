<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajax</title>
</head>
<body>
    
  
<div id= "displayoutput"></div>
<form action="" method="post">
<input type="text" name="code" id="actualcode" placeholder = "Enter the verification code">

<input type="button" id="verify" value="verify code">
</form>


<script src="ajaxjquery.js"></script>

<script>
$(document).ready(function(){

var code = document.getElementById('actualcode');

var button = document.getElementById('verify');


button.addEventListener('click', submitform);

function submitform(){
    
  //  alert('i am here');

  var code1 = code.value;

  $.ajax({
    url: "testing2.php",
    method: "post",
    data: { code1:code1 },
    success: function(data){

        $("#displayoutput").html(data);


    }

  })

    
   






}







})

    



</script>


</body>
</html>