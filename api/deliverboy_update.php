<?php
include('config.php');
header('Content-Type: application/json');
$response=array();

if(isset($_REQUEST['email']))

{
  $em = $_REQUEST['email'];
  $name = $_REQUEST['name'];
  $pass = $_REQUEST['password'];
  $mob = $_REQUEST['mobile'];
  
$query=mysqli_query($con,"update deliveryboy SET name='$name', password='$pass',mobile='$mob' where email='$em'");

  $response['success']='1';  
}
else
{
 
 $response['success']='0';
   
}

echo  (json_encode($response));
?>