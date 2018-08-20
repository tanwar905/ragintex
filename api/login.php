 <?php
 
 
 
include("config.php");
header('Content-Type: application/json');
$response=array();


if(isset($_REQUEST['em'])&&isset($_REQUEST['password']))

{
  $em = $_REQUEST['em'];


 $password = $_REQUEST['password'];


$ss = mysqli_query($con,"select * from deliveryboy where email = '$em' and password = '$password'");

  $ss_count = mysqli_num_rows($ss);

if($ss_count == 0 )
{
	 $response['success']='0';


}
else
{
 
 
 
 
 $response['success']='1';
   
    

}}
echo  (json_encode($response));
?>
  
  
  
  

  