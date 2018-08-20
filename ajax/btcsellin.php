<?php

include "config.php";
$session_id= $_SESSION['useremail']; 
 if($session_id == '')
{
    //header('location:ind_3.php');
    
    echo 'You are not autherised to access please login';
       die();
       exit();
}

if(isset($_GET['coin']))
{
$coin = $_GET['coin'];
}else
{
    $coin = 0;
}

     $emaill=$_SESSION['useremail'];
     $user_id=$_SESSION['user_id'];
     $btc_vall=$_GET['bb'];
      extract($_REQUEST);
    
     if($coin=='0'){
      
     if($btccheack < $ramount){
       
         
         echo "Your wallet balance is low Please Deposit amount in your wallet";
         exit();
         
     }
   else{
   
      if($currency == 0)
      {
          $recbuy = $recbuy_inr;
      }else
      {
          $recbuy = $recbuy_myr;
      }
      
     $adfee=($ramount/$feea)/100;
    echo "INSERT INTO `transaction` (`tid`, `user_id`,`seller_email`, `buyer_email`, `total_coin`,`fees`,`admin_fee`,`currency`,`amount`,`type`,`buyer_status`,`seller_status`,`admin_status`,`coin_type`) VALUES ('$btc_vall', '$user_id','$emaill','$seller_email', '$ramount','$feea','$adfee','$currency' ,'$recbuy','0','0','0','pending','$coin')";
    die;
 mysqli_query($con,"INSERT INTO `transaction` (`tid`, `user_id`,`seller_email`, `buyer_email`, `total_coin`,`fees`,`admin_fee`,`currency`,`amount`,`type`,`buyer_status`,`seller_status`,`admin_status`,`coin_type`) VALUES ('$btc_vall', '$user_id','$emaill','$seller_email', '$ramount','$feea','$adfee','$currency' ,'$recbuy','0','0','0','pending','$coin')");

//header("location:sell_list.php?id=$btc_vall&user_id=$user_id&amt=$ramount");

echo "success";
exit();
//echo '<script>window.location.href="fill_bank_detail.php?id='.$btc_vall.'&user_id='.$user_id.'&amt='.$ramount.'&ccooin='.$coin.'"</script>';
   
   }
     } 
     else{
         
         if($ehtcheack < $ramount){
         
         echo "Your wallet balance is low Please Deposit amount in your wallet";
         exit();
         
     }
   else{
    
      if($currency == 0)
      {
          $recbuy = $recbuy_inr;
      }else
      {
          $recbuy = $recbuy_myr;
      }
      
     $adfee=($ramount/$feea)/100;
     
 mysqli_query($con,"INSERT INTO `transaction` (`tid`, `user_id`,`seller_email`, `buyer_email`, `total_coin`,`fees`,`admin_fee`,`currency`,`amount`,`type`,`buyer_status`,`seller_status`,`admin_status`,`coin_type`) VALUES ('$btc_vall', '$user_id','$emaill','$seller_email', '$ramount','$feea','$adfee','$currency' ,'$recbuy','0','0','0','pending','$coin')");

//header("location:sell_list.php?id=$btc_vall&user_id=$user_id&amt=$ramount");

echo "success";
//echo '<script>window.location.href="fill_bank_detail.php?id='.$btc_vall.'&user_id='.$user_id.'&amt='.$ramount.'&ccooin='.$coin.'"</script>';
   
   }
         
     }
?>