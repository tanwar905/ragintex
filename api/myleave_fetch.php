 <?php
 include("config.php");
header('Content-Type: application/json');
$response=array();

 if(isset($_REQUEST['email'])){ 
     
     $rr=$_REQUEST['email'];

$ss = mysqli_query($con,"select * from myleave where email='$rr'");

 while($ss_count = mysqli_fetch_array($ss)){
    

 $response['data'][]=$ss_count;



}

}

echo  (json_encode($response));
?>
  
  
  
  

  