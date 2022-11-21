<?php
date_default_timezone_set('Asia/Calcutta');
$conn = mysqli_connect('localhost','dbo_mayraspa','mayraspa657$#','mayraspa')or die("unable to connect");
function insertData($email,$company,$conn){
	echo $email.$company;
	$sql = "INSERT INTO dowonloadform(email,comapny) VALUES('$email','$comapny')";
	mysqli_query($conn,$sql);	
}
insertData($_POST['email'],$_POST['companyname'],$conn);


// $sql = "SELECT * FROM dowonloadform";
// $result = mysqli_query($conn,$sql);
// $rows =  mysqli_num_rows($result);
// if($rows >= 1){
// 	$careted_at = '';
// 	while($res = mysqli_fetch_assoc($result) ){			
// 		$careted_at .= $res['created_at'];		
// 	}
// }
// echo $datetime_2 = date("Y-m-d H:i:s"); 
// echo "<br>";
// echo $datetime_1 = date('Y-m-d H:i:s', strtotime(' -1 day'));
// //echo $datetime_1 = $careted_at;
// $from_time = strtotime($datetime_1); 
// $to_time = strtotime($datetime_2);
// echo "<br>";
// echo $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
// if( $diff_minutes < 25){
// echo "<br>Show";
// }else{
// 	echo "<br>Hide";
// }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
	    <form action="enqProcess.php" method="post" id="enq-form_pop" >
    	 <div class="form-group">
		    <label for="exampleInputEmail1">Name*</label>
		    <input type="text" class="form-control onlycharallow" maxlength="100" name="fullname" id="fullname" aria-describedby="fullname" placeholder="Name*">
		    <span class="form-text error-msg" id="nameError-service"></span> 
		    
	  	</div>	
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="text" class="form-control" maxlength="100" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail*">
		    <span  class="form-text error-msg" id="emailError-service"></span> 

		  </div>
		  <div class="form-group">
		    <label for="exampleInputEmail1">Contact Number*</label>
		    <input type="text" class="form-control onlynumallow" maxlength="15" minlength="8" name="contactnumber" id="contactnumber" aria-describedby="contactnumber" placeholder="Contact Number*">
		    <span  class="form-text error-msg" id="mobileError-service"></span> 

	  	</div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Company Name*</label>
		    <input type="text" class="form-control" maxlength="100" name="companyname" id="companyname" placeholder="Company Name*">
		    <span  class="form-text error-msg" id="comapnyError"></span> 

		  </div>		  
		  <button type="submit" class="btn btn-primary" id="formSubmit-pop" >SUBMIT</button>
		</form>
	</div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
  </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

function validateChar(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 123)) {
		if(charCode == 8 || charCode == 32 || charCode == 9) return true;
		else return false;
	} else return true;
}

function validateNum(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode > 57)) {
		if(charCode == 43 || charCode == 40 || charCode == 41 || charCode == 9) return true;
		else return false;
	} else return true;
}
	
//enq service form
$(document).ready(function(){	
	jQuery('.onlycharallow').attr('onKeyPress', 'return validateChar(event)');
	jQuery('.onlynumallow').attr('onKeyPress', 'return validateNum(event)');

  $('#enq-form_pop').on('submit',function(event){  
  var name = $('#fullname').val();
  var email = $('#email').val();
  var mobile = $('#contactnumber').val();
  var company = $('#companyname').val();

  // name validation 
  var name_regex = /^[a-zA-Z ]+$/;
  if (!name.match(name_regex) || name.length == 0) {
    $('#nameError-service').html("<span id='nameErr-service' >For your name please use alphabets only</span>"); 
    $("#exampleInputname").focus();
    return false;
  }else{
     $("#nameErr-service").fadeOut();
  }

   // Email validation 
  var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!email.match(email_regex) || email.length == 0) {    
    $('#emailError-service').html("<span id='mailErr-service' >Please enter a valid email address</span>"); // This Segment Displays The Validation Rule For Email
    $("#email").focus();
    return false;
  }else{
     $("#mailErr-service").fadeOut();
  } 
  // mobile number validation
  var mobile_regex = /^[0-9]+$/;
  if (!mobile.match(mobile_regex) || mobile.length == 0) {
    $('#mobileError-service').html("<span id='mobileErr-service' >For your mobile please use number only</span>"); 
    $("#mobile").focus();
    return false;
  }else{
     $("#mobileErr-service").fadeOut();
  } 
	// company name
	if (company.length == 0) {
		$('#comapnyError').html("<span id='companyErr-service' >Comany name should not blank</span>"); 
		$("#exampleInputname").focus();
	return false;
	}else{
		$("#companyErr-service").fadeOut();
	} 
  
  });
});
// from submission. 
$(function () {
        $('#enq-form_pop').on('submit', function (e) {
        	//alert("Hi")
          e.preventDefault();
          $.ajax({
          type: 'POST',
            url: 'enqProcess.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,            
            beforeSend: function() {                            
              $("#formSubmit-pop").attr('disabled',true)
            },
            complete: function() {
            	$("#formSubmit-pop").attr('disabled',false)             	
            },                      
            success: function (data,status) {                                              
            	if(data['data_resp'] == 'error'){           		            		
            		$("#sent_msg-service").text(data['comm_error']);      
            		$("#sent_msg-service").removeClass( 'success-msg' )     	            	          
            		$("#sent_msg-service").addClass( data['error_msg'] )              	          
            		//window.location.href="https://development.ikf.in/myrahspa/thank-you.php";

            	}
            	if(data['data_resp'] == 'success'){            		            		
	            	$("#sent_msg-service").text(data['comm_succ']);
	            	$("#sent_msg-service").removeClass("error-msg")   
	            	$("#sent_msg-service").addClass( data['success_msg'] ) 
	            	//window.location.href="https://development.ikf.in/myrahspa/thank-you.php";              	                      			            	          

            	}          	
            	
            }            
          });
        });
      });
</script>
