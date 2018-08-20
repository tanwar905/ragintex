 <?php
 
 
 
include("config.php");
header('Content-Type: application/json');
$response=array();


if(isset($_REQUEST['emaill'])&&isset($_REQUEST['orderid']))

{
  $em = $_REQUEST['emaill'];

 $id = $_REQUEST['orderid'];

$ss = mysqli_query($con,"update assigndeliveryboy set status='success' where email = '$em' and orderid = '$id'");



	 $response['success']='1';


}
else
{
 
 
 
 
 $response['success']='0';
   
    

}
echo  (json_encode($response));
?>
  
  
  
  

  