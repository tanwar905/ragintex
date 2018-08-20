<?php
//die("kjsdhckjsd");
if(isset($_GET['coin']))
{
$coin = $_GET['coin'];
}else
{
$coin = 0;
}
?>
<?php

include('config.php');

     
     $emaill=$_SESSION['useremail'];
     $user_id=$_SESSION['user_id'];
     $btc_vall=$_GET['aa'];
     $coin1=$_GET['coin'];
    
    //extract($_REQUEST);
    
    $seller_email = $_REQUEST['seller_email'];
    $buy = $_REQUEST['buyy'];
    $recbuy = $_REQUEST['recbuy'];
    $btcIn = $_REQUEST['btcIn'];
    $currency = $_REQUEST['currency'];
    $recbuy_inr = $_REQUEST['recbuy_inr'];
    $recbuy_myr = $_REQUEST['recbuy_myr'];
      if($recbuy == '')
      {
          $recbuy2 = $_SESSION['btc_add'];
      }else
      {
          $recbuy2 = $recbuy;
      }
      if($currency == 0)
      {
          $recbuy = $recbuy_inr;
      }else
      {
          $recbuy = $recbuy_myr;
      }
      
      mysqli_query($con,"INSERT INTO `transaction` ( `tid`,`user_id`,`seller_email`, `buyer_email`, `total_coin`,`currency`,`payment_method`,`amount`,`address`,`type`,`buyer_status`,`seller_status`,`admin_status`,`coin_type`) VALUES ('$btc_vall', '$user_id','$seller_email','$emaill', '$buy','$currency','$btcIn' ,'$recbuy','$recbuy2','0','0','0','pending','$coin')");
  
    echo "success";
    //echo '<script>window.location.href="banklist.php?bank_id='.$btc_vall.'&conm='.$coin1.'"</script>';

    
    
?>