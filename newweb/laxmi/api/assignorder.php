 <?php
 
 
 
include("config.php");
header('Content-Type: application/json');
$response=array();


if(isset($_REQUEST['emaill']))

{
  $em = $_REQUEST['emaill'];

$ss = mysqli_query($con,"select * from assigndeliveryboy where ` email` = '$em' AND status='pending'");


while($ppi=mysqli_fetch_array($ss)){
  $ss_count[] = $ppi;

	 $response['success']=array($ss_count);
}

}
else
{
 
 $response['success']='0';
   
}

echo  (json_encode($response));
?>
  
  
  
  

  