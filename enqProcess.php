<?php
include('smtp/PHPMailerAutoload.php');
date_default_timezone_set('Asia/Calcutta');

$yourname = $_POST['fullname'];
$yourmobile = $_POST['contactnumber'];
$youremail = $_POST['email'];
$companyname = $_POST['companyname'];
// change the database connections
$conn = mysqli_connect('localhost','dbo_mayraspa','mayraspa657$#','mayraspa')or die("unable to connect");
function insertData($yourname,$email,$yourmobile,$company,$conn){
    echo $email.$company;
    $sql = "INSERT INTO dowonloadform(name,email,contact,comapny) VALUES('$yourname','$email','$yourmobile','$company')";
    mysqli_query($conn,$sql);   
}
function smtp_mailer1($to,$subject,$msg){            
    $mail = new PHPMailer(); 
    $mail->SMTPDebug  = 3;
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com"; // smtp change
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "helpdesk@ikf.co.in"; // smtp email
    $mail->Password = "Help987$#"; // pass
    $mail->SetFrom("helpdesk@ikf.co.in"); // email
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
     $mail->ClearReplyTos();
    $mail->addReplyTo('helpdesk@ikf.co.in', 'MetaSys');
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    $resp = [];
    if(!$mail->Send()){ 
    
    }else{

      
        }
    }

//admin                          
function smtp_mailer($to,$subject,$msg){            
    $mail = new PHPMailer(); 
    $mail->SMTPDebug  = 3;
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com"; // smtp change
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "helpdesk@ikf.co.in"; // smtp email
    $mail->Password = "Help987$#"; // pass
    $mail->SetFrom("helpdesk@ikf.co.in"); // email
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
     $mail->ClearReplyTos();
    $mail->addReplyTo('helpdesk@ikf.co.in', 'MetaSys');
    $mail->SMTPOptions=array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false
    ));
    $resp = [];
    if(!$mail->Send()){ 
        $resp['comm_error'] = "There was an error trying to send your message. Please try again later.";
        $resp['error_msg'] = "error-msg";
        $resp['data_resp'] = 'error';
        return json_encode($resp);      
    }else{

        $resp['comm_succ'] =  'Your form has been submitted successfully!!';
        $resp['success_msg'] = 'success-msg';
        $resp['data_resp'] = 'success';
        return json_encode($resp);  
        }
    }

    if( ( !empty($yourname) ) && ( !empty($yourmobile) ) && ( !empty($youremail) ) && ( !empty($companyname) ) ){   
        $regex = '/^[a-zA-Z ]*$/';
        if( (preg_match($regex,$yourname)  == true)  ){
            $name = 1;          
        }   else{
            $name = 0;
        }
        //mobile number
        $regmob = "/^[0-9]{8,15}+$/";
        if( (preg_match($regmob,$yourmobile)  == true)  ){
            if( strlen($yourmobile) < 8  || strlen($yourmobile) > 15 ){
                $mobile = 0;                
            }else{
                 $mobile= 1;                
            }           
        }else{
             $mobile    = 0;
        }
        if($name == 1 && $mobile == 1 ){
            if( !empty($yourname ) && !empty($yourmobile) &&  !empty($youremail) && !empty($companyname) ){
                
                insertData($yourname,$_POST['email'],$yourmobile,$companyname,$conn);               
            } 
            //admin
            $subject = "Contact Form Submission For - MetaSys";
            $msg = "Dear Team ,<br> We have received below details from <strong>MetaSys</strong> website Contact Form submitted today.<br>";           
            $msg .= "Name:".$yourname;
            $msg .= "<br>Contact No:".$yourmobile;
            $msg .= "<br>Email:".$youremail;
            $msg .= "<br> Service: ".$companyname;                        
            $msg .= "<br><br><br>";
            $msg .= "Thanks & Regards,<br>";
            $msg .= "<strong>MetaSys</strong>";
            echo smtp_mailer( 'laxmantest2525@gmail.com',$subject,$msg);            
            
            // user reply
            $user_msg = "Dear ".$yourname.",<br>";
            $user_msg .= "You are receiving this e-mail because you or someone using this e-mail address requested information on downloading a MetaBiz trial version from MetaSys Software.<br /><br />The details entered are as follows:<br />";
            $user_msg .= "Name :".$yourname;
            $user_msg .= "<br>Email: ".$youremail;
            $user_msg .= "<br>Phone: ".$yourmobile; 
            $user_msg .="<br>You can click here <a href='https://development.ikf.in/testing/download/select.php'>download</a> to download your free software. This link is valid for 24 hours only.  Once you download the application, unzip it to the folder and please read the file named 'Read Me' to know more about installing the application.<br>";          
            $user_msg .= "Thanks & Regards,<br>";
            $user_msg .= "<strong>MetaSys</strong>";
            echo smtp_mailer1( $youremail,$subject,$user_msg);
        }   
    }

?>