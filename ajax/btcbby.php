<?php
if(isset($_GET['coin']))
{
$coin = $_GET['coin'];
}else
{
    $coin = 0;
}
?>
<?php

include "config.php";
$session_id= $_SESSION['useremail']; 
 if($session_id == '')
 {
   echo 'You are not autherised to access please login';
   die();
   exit();
   //header('location:ind_3.php');
 }

  $btc_val=$_GET['aa'];
  $data=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail LEFT JOIN buyer ON bank_detail.tid = buyer.code where buyer.code = '$btc_val'");
  
  $data_val=mysqli_fetch_array($data);
  
  $gtt=mysqli_query($con,"select * from fees_manage");
  $gttfetch=mysqli_fetch_array($gtt);
  $feet=$gttfetch['amount'];
  
  $gt=mysqli_query($con,"select * from add_btc");
  $gtfetch=mysqli_fetch_array($gt);
  $addamount=$gtfetch['btc_buy'];
  
  
  if($coin == 0)
  {
    $url = "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=INR";
    curl_setopt($ch, CURLOPT_URL,$url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
    curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
    curl_setopt($ch, CURLOPT_REFERER, 'https://www.quikcoin.in/');
    $dir                   = dirname(__FILE__);
    $config['cookie_file'] = $dir . '/cookies/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';
    curl_setopt($ch, CURLOPT_COOKIEFILE, $config['cookie_file']);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $config['cookie_file']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
    // This is what solved the issue (Accepting gzip encoding)
    curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
     $response = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($response);
    $btc  = $obj->{'INR'};
  
    $total=$addamount+$btc;
  
  
  //ringet btc price
$url = "https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=MYR";
curl_setopt($ch, CURLOPT_URL,$url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.quikcoin.in/');
$dir                   = dirname(__FILE__);
$config['cookie_file'] = $dir . '/cookies/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';
curl_setopt($ch, CURLOPT_COOKIEFILE, $config['cookie_file']);
curl_setopt($ch, CURLOPT_COOKIEJAR, $config['cookie_file']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
$response = curl_exec($ch);
curl_close($ch);

$obj1 = json_decode($response);
$eth  = $obj1->{'MYR'};

$total1=$addamount+$eth;
  }else
  {
  $url = "https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=INR";
curl_setopt($ch, CURLOPT_URL,$url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.quikcoin.in/');
$dir                   = dirname(__FILE__);
$config['cookie_file'] = $dir . '/cookies/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';
curl_setopt($ch, CURLOPT_COOKIEFILE, $config['cookie_file']);
curl_setopt($ch, CURLOPT_COOKIEJAR, $config['cookie_file']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
 $response = curl_exec($ch);
curl_close($ch);

$obj = json_decode($response);
 $btc  = $obj->{'INR'};
  
  $total=$addamount+$btc;
  
  
  //ringet btc price
$url = "https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=MYR";
curl_setopt($ch, CURLOPT_URL,$url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
$config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';
curl_setopt($ch, CURLOPT_USERAGENT, $config['useragent']);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.quikcoin.in/');
$dir                   = dirname(__FILE__);
$config['cookie_file'] = $dir . '/cookies/' . md5($_SERVER['REMOTE_ADDR']) . '.txt';
curl_setopt($ch, CURLOPT_COOKIEFILE, $config['cookie_file']);
curl_setopt($ch, CURLOPT_COOKIEJAR, $config['cookie_file']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
$response = curl_exec($ch);
curl_close($ch);

$obj1 = json_decode($response);
$eth  = $obj1->{'MYR'};

$total1=$addamount+$eth;
  }
  
  
  $show=mysqli_query($con,"select * from register where email='$session_id'");

$fetchshow=mysqli_fetch_array($show);
 $state=$fetchshow['country'];
  
?>

 <div class="col-md-2">
                               
                            </div>
                            <input type="hidden" class="form-control" name="seller_email" id="buyy" required value="<?php echo $data_val['user_email']; ?>" readonly>
                            
                            <div class="col-md-3">
                                <h4>Amount Of <?php if($coin == 0){echo "BTC";}else{echo "ETH";}?></h4><?php $am=$data_val['amount']; $df=($am*$feet)/100; $tamo=$am+$df;  ?>
                                <input type="text" class="form-control" name="buy" id="buyy1" required value="<?php echo $tamo; ?>" readonly>
                            </div>
                            <div class="col-md-3">
                                <h4>Amount Of INR</h4>
                                <input type="text" class="form-control" name="recbuy_inr" id="totalbtc" required value="<?php echo $total*$data_val['amount']; ?>" readonly>
                                <input type="hidden" value="<?php echo $total; ?>" name="bbt" id="bbt" >
                            </div>
                            <div class="col-md-3">
                                <h4>Amount Of MYR</h4>
                                <input type="text" class="form-control" name="recbuy_myr" id="totaletc" required value="<?php echo $data_val['amount']*$total1; ?>" readonly>
                                <input type="hidden" value="<?php echo $total; ?>" name="bbt" id="bbt">
                            </div>
                             <div class="col-md-1">
                                
                            </div>
                        </div>
                        
                         <div class="row">
                              <div class="col-md-2">
                               
                            </div>
                            <div class="col-md-4">
                                <h4>Recive <?php if($coin == 0){echo "BTC";}else{echo "ETH";}?> To*</h4>
                                <!--<input type="text" class="form-control" name="buy" id="etc" required>
                                <input type="hidden" value="<?php echo $total1; ?>" name="bbut" id="bbut">-->
                                <select class="form-control" required name="btcIn" id="btcIn">
                                    <option value="">Receive <?php if($coin == 0){echo "BTC";}else{echo "ETH";}?> In</option>
                                    <option value="0">Wallet</option>
                                    <option value="1">Personal <?php if($coin == 0){echo "BTC";}else{echo "ETH";}?> Address</option>
                                </select>
                                <?php $fees = mysqli_query($con,"select * from fees_manage"); 
                                $fee = mysqli_fetch_array($fees);
                                ?>
                                <h4>Withrawal fees <?php echo $fee['amount']; ?></h4>
                            </div>
                            <div class="col-md-4 hide ss">
                                <h4>Fill address*</h4>
                                <input type="text" class="form-control" name="recbuy" id="recbuy">
                            </div>
                            
                            <div class="col-md-4">
                                <h4>Select currency*</h4>
                                <!--<input type="text" class="form-control" name="buy" id="etc" required>
                                <input type="hidden" value="<?php echo $total1; ?>" name="bbut" id="bbut">-->
                                <select class="form-control" required name="currency" id="currency" readonly>
                                      <?php if($state=='INR') { ?>
                                    <option value="0">INR</option>
                                 <?php } 
                else { ?>
                                    <option value="1">MYR</option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            
                            <div class="col-md-4">
                                <h4></h4>
                               <button class="btn btn-block btn-primary btn-continue" type="submit" name="submit_buyy" style="margin-top: 38px;padding:  12px;" >Buy <?php if($coin == 0){echo "BTC";}else{echo "ETH";}?></button>
                            </div>
						     <div class="col-md-2">
                               
                            </div>
						    
						</div>
