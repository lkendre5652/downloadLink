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
		<form action="" method="post" id="downloadForm">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">		    
		    <span  class="form-text error-msg" id="emailError-service"></span> 		    
		  </div>		  
		  <button type="submit" class="btn btn-primary" id="formSubmit-pop">Search</button>
		</form>
	</div>
	<div id="downloadLink" style="display: none;"><a href="">Download Link</a></div>
	<div id="ErrorNotFound" style="display: none;">Not Found!!</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>	
//enq service form
$(document).ready(function(){	
  $('#downloadForm').on('submit',function(event){  
  var email = $('#email').val();
  // Email validation 
  var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!email.match(email_regex) || email.length == 0) {    
    $('#emailError-service').html("<span id='mailErr-service' >Please enter a valid email address.</span>"); // This Segment Displays The Validation Rule For Email
    $("#email").focus();
    return false;
  }else{
     $("#mailErr-service").fadeOut();
  }  
  
  });
});
// from submission. 
$(function () {
        $('#downloadForm').on('submit', function (e) {        	
          e.preventDefault();
          $.ajax({
          type: 'POST',
            url: 'downloadProcess.php',
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
            	if(data.found === 1 ){            		
            		jQuery("#ErrorNotFound").hide();
            		jQuery("#downloadLink a").attr('href',data.url);
            		$("#downloadLink").show();
            	}else{            		
            		jQuery("#ErrorNotFound").show();
            		jQuery("#downloadLink a").attr('href',"");
            		$("#downloadLink").hide();
            	}                      	        	            	
            }            
          });
        });
      });
</script>
  </body>
</html>
<?php
/*
date_default_timezone_set('Asia/Calcutta');
$conn = mysqli_connect('localhost','dbo_mayraspa','mayraspa657$#','mayraspa')or die("unable to connect");
function showData($email,$conn){
		 $olddate = date("Y-m-d H:i:s", strtotime(' -1 day'));		 
		 $curdate = date("Y-m-d H:i:s");		 
		$sql = "SELECT * FROM dowonloadform where email = '$email' AND created_at BETWEEN  '$olddate' and '$curdate' ";	
		$result = mysqli_query($conn,$sql);
		$rows =  mysqli_num_rows($result);
		if($rows >= 1){		
			while($res = mysqli_fetch_assoc($result) ){							
				// echo "#". $res['email'].'<br>';
				// echo "# current date : ". $curdate.'<br>';
				//echo "# old Date: ". $res['created_at'].'<br>';
				$from_time = strtotime($curdate);  								
				$to_time = strtotime($res['created_at']);				
				$diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
				if($diff_minutes <= 1440 ){
					return 1;
				}else{
					return 0;
				}				
			}
		}
}
$email = !empty($_POST['email'])? $_POST['email'] : "NULL";
$result = showData($email,$conn);
if($result == 1 ){ ?>
	<form action="download.php">	
		<button type="button">Download</button>
	</form>
<?php echo "<br>Show";
}else{
	echo "Nothing Found!!!";
}
*/
?>
