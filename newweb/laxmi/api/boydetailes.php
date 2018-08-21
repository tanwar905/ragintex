 <?php
 
 
 
include("config.php");
header('Content-Type: application/json');
$response=array();


if(isset($_REQUEST['emaill']))

{
  $em = $_REQUEST['emaill'];

$ss = mysqli_query($con,"select * from deliveryboy where email = '$em' ");

  $ss_count[] = mysqli_fetch_array($ss);

	 $response['success']=array($ss_count);


}
else
{
 
 $response['success']='0';
   
}

echo  (json_encode($response));
?>
  
  
  
  

  