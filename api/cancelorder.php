<?php
 include("config.php");
header('Content-Type: application/json');
$response=array();



if(isset($_REQUEST['orderid'])){ 
    
    
    
     $rr=$_REQUEST['orderid'];
     $rp=$_REQUEST['reason'];
     $ema=$_REQUEST['email'];
     
 $ss = mysqli_query($con,"select * from assigndeliveryboy where ` orderid` = '$rr'");
 
 if($ss=$rr)
 {
    
$query=mysqli_query($con,"update assigndeliveryboy SET status='cancel'  where orderid='$rr'");

$ss = mysqli_query($con,"select * from assigndeliveryboy where ` orderid` = '$rr'");
$ssfetch=mysqli_fetch_array($ss);
$email=$ssfetch['email'];

mysqli_query($con,"INSERT INTO `cancel_order` ( `orderid`,`reason`,`email`)  VALUES ( '$rr','$rp','$ema')");

    
 $response['success']='1';  
 }  
}
else
{
 
 $response['success']='0';
   

}
echo  (json_encode($response));
?> 