<?php
include('config.php');

echo  $email =   $_SESSION['useremail'];;


    $reg=mysqli_query($con,"select * from `register` where email='$email'");
   

    
    $regfetch=mysqli_fetch_array($reg);
   

echo  $details=$regfetch['name'].','.$regfetch['email'].','.$regfetch['number'].','.$regfetch['kyc_status'].','.$regfetch['country'];




?>