<?php
include('config.php');
header('Content-Type: application/json');
$response=array();

if(isset($_REQUEST['email'])){

$email=$_REQUEST['email'];
$date=$_REQUEST['date'];
$reason=$_REQUEST['reason'];
$date2=$_REQUEST['date2'];
$status=$_REQUEST['status'];

$query=mysqli_query($con,"insert into myleave (email,date,reason,date2,status) values('$email','$date','$reason','$date2','$status')");


  $response['success']='success';

}
else
 {   
     $response['success']='fail';
    
}


echo  (json_encode($response));
?>