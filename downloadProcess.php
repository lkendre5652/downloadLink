<?php
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
$res = array();

if($result == 1 ){ 
	$res['found'] = 1;
	$res['url'] = 'https://development.ikf.in/testing/download/select.php';	
	echo json_encode($res); 	
}else{
	$res['found'] = 0;
	$res['url'] = '';	
	echo json_encode($res); 	
	
}
?>