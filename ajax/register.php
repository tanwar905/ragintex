<?php

include('config.php');


    
     //extract($_REQUEST);
     
     $name = $_REQUEST['name'];
     $email = $_REQUEST['email'];
     $password = $_REQUEST['password'];
     $number = $_REQUEST['number'];
     $reff = $_REQUEST['refrel'];
     $country = $_REQUEST['country'];
     
     
    $reg = mysqli_query($con,"select * from register where email ='$email'");
    
    $regnnum=mysqli_num_rows($reg);
    
    
    
    
    if($regnnum == 1)
    {
        
        echo "Your Email is Already Registerd";
        die();
        exit();
        
       //echo '<script>window.location.href="register.php"</script>';

    
        //header("location:register.php");
    }
    
    
   
$url = "https://block.io/api/v2/get_new_address/?api_key=6277-d41f-8114-53cc";

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
 $responsebtc = curl_exec($ch);
curl_close($ch);


$man=json_decode($responsebtc);

foreach($man as $key=>$val){
  foreach($val as $k=>$v){
   if($k=='address')
   {
    
    $btcaddress= $v;
   }
  }
}



$url = "https://api.blockcypher.com/v1/beth/test/addrs?token=65cf118c9f3349398e165ae8f029b59c";
curl_setopt($ch, CURLOPT_URL,$url);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
$ethaddress = curl_exec($ch);
curl_close($ch);

$obj = json_decode($ethaddress);


$address5 = $obj->{'address'};

 $private = $obj->{'private'};
 $public = $obj->{'public'}; 
 
 
 include("class.phpmailer.php");
	
	
	// Email Using Google Account
/*	$mail = new PHPMailer(); // create a new object
  $mail->IsSMTP(); // enable SMTP
  $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->Host = "ragiantex.com";
  $mail->Port = 25; // or 587
 $ff=$email;
 $emailk='email verification';
 $message='https://www.ragiantex.com/checkemail.php?man='.$ff.'';
  $mail->IsHTML(true);  
   
  $mail->Username = "noreply@ragiantex.com";
  $mail->Password = "manish@123";
  $mail->SetFrom("noreply@ragiantex.com", 'Name',0);
  
  $mail->FromName = "ragiantex";
  $mail->Subject = $emailk;
  $mail->Body ='Please open this link for verfication your mail  '.$message;
  
  $mail->AddAddress($ff);
  
  $mail->IsHTML(true); 
  
   if($mail->Send())
   {
   
   //echo "Success";
   }
   else
   {
   echo "failure";
   }*/
	
	$ref=ref.rand(234,998765);
	
	$fft=mysqli_query($con,"select * from register where reffral_code='$reff'");
	$fftfetch=mysqli_fetch_array($fft);
	$refgmail=$fftfetch['btcaddress'];
	
	
		$afft=mysqli_query($con,"select * from admin_address");
	$afftfetch=mysqli_fetch_array($afft);
	$arefgmail=$afftfetch['btc_add'];
	
	
	$afsft=mysqli_query($con,"select * from reffral_amount");
	$afsftfetch=mysqli_fetch_array($afsft);
	$asrefgmail=$afsftfetch['amount'];
	
	
	 $url1 = "https://block.io/api/v2/withdraw_from_addresses/?api_key=6277-d41f-8114-53cc&from_addresses=".$arefgmail."&to_addresses=".$refgmail."&amounts=".$asrefgmail."&pin=COS001589";
 
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch1, CURLOPT_ENCODING, "gzip,deflate");    
  $dogeresponse1 = curl_exec($ch);
curl_close($ch);
 $dogesell1=json_decode($dogeresponse1);
$tid61=$rand1=rand(500,3000000);
 $dogestatus1=$dogesell1->status;
 $dogebtckk1=$_REQUEST['manishpali'];
 
           
        
	 
    
    mysqli_query($con,"INSERT INTO `register` ( `name`, `email`, `password`, `number`, `status` ,`kyc_status`,`country`,`reffral_code`,`reffral_by`,`btcaddress`,`ethaddress`,`public`,`private`) VALUES ('$name', '$email', '$password', '$number','pending','0','$country','$ref','$reff','$btcaddress','$address5','$public','$private')");
    
    
    echo "Registration Successfully Completed Please Check Your E-mail for Verifaction";
    
    //echo '<script>window.location.href="ind_3.php"</script>';

    
    //header("location:ind_3.php");
    






?>