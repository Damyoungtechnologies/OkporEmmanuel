

$(document).ready(function(){

var name = document.getElementById('nameutme');
var dept = document.getElementById('deptutme');
var phone = document.getElementById('phoneutme');
var jambregno = document.getElementById('jambregnoutme');
var button = document.getElementById('postutmeadd');


button.addEventListener('click', submitform);

function submitform(){
    
  //  alert('i am here');

  var name1 = name.value;
  var  dept1 = dept.value;
  var  phone1 = phone.value;
  var jambregno1 = jambregno.value;

  $.ajax({
    url: "../component/utmeadd.php",
    method: "post",
    data: { name1:name1, dept1: dept1, phone1:phone1, jambregno1: jambregno1 },
    success: function(data){

        $("#displayoutput").html(data);


    }

  })

    
   






}







})

    