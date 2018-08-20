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

$ad=mysqli_query($con,"select * from register where email='$session_id'");
$adfetch=mysqli_fetch_array($ad);
$bbaddress=$adfetch['btcaddress'];
$eeaddress=$adfetch['ethaddress'];


          
// = "https://api.blockcypher.com/v1/".$coinmarket."/main/addrs/".$address."/balance";
$url="https://block.io//api/v2/get_address_balance/?api_key=6277-d41f-8114-53cc&addresses=".$bbaddress."";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
  $response = curl_exec($ch); 
curl_close($ch);

$obj =  json_decode($response,true);

//echo $balance = $obj->{'available_balance'};
 $btvbalance = $obj['data']['available_balance'];
        

         $url = "https://api.blockcypher.com/v1/eth/main/addrs/".$eeaddress."/balance";
//$url="https://block.io//api/v2/get_address_balance/?api_key=6277-d41f-8114-53cc&addresses=".$address."";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
// This is what solved the issue (Accepting gzip encoding)
curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");    
  $response = curl_exec($ch); 
curl_close($ch);

$obj =  json_decode($response);

   $etvbalance = $obj->{'balance'};
 //$balance = $obj['data']['available_balance'];

  $btc_val=$_GET['bb'];
  $data=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail LEFT JOIN buyer ON bank_detail.tid = buyer.code where buyer.code = '$btc_val'");
  //echo "SELECT bank_detail.*, buyer.* from bank_detail LEFT JOIN buyer ON bank_detail.user_id = buyer.user_id where buyer.user_id = $btc_val";
  $data_val=mysqli_fetch_array($data);
  
  $gt=mysqli_query($con,"select * from add_btc");
  $gtfetch=mysqli_fetch_array($gt);
  $addamount=$gtfetch['btc_buy'];
  
  $gtt=mysqli_query($con,"select * from fees_manage");
  $gttfetch=mysqli_fetch_array($gtt);
  $feet=$gttfetch['amount'];
  
  if($coin==0){ $coinf='BTC' ; }else {  $coinf= 'ETH';   }
  
  $url = "https://min-api.cryptocompare.com/data/price?fsym=".$coinf."&tsyms=INR";
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

$url = "https://min-api.cryptocompare.com/data/price?fsym=".$coinf."&tsyms=MYR";
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

$show=mysqli_query($con,"select * from register where email='$session_id'");

$fetchshow=mysqli_fetch_array($show);
$state=$fetchshow['country'];

  
?>

    <div class="tabbable-panel">
    	<div class="tabbable-line">
    		<div class="tab-content">
    			<div class="tab-pane active" id="tab_default_1">
    				<div class="row">
    					<form method="post" id="btcselll">
    						<div class="col-md-2">
                            </div>
                            <input type="hidden" class="form-control" name="seller_email" id="buyy" required value="<?php echo $data_val['user_email']; ?>" readonly>
                            <div class="col-md-3">
                                <h4>Amount Of <?php if($coin == 0){ echo "BTC"; }else{echo "ETH";}?></h4><?php $am=$data_val['amount']; $df=($am*$feet)/100; $tamo=$am+$df;  ?>
                                <input type="text" class="form-control" name="buy" id="buyy" required value="<?php echo $tamo; ?>" readonly>
                                <?php $_SESSION['bhy']=$tamo; ?>
                                <input type="hidden" value="<?php echo $data_val['amount'] ?>" name="ramount">
                                <input type="hidden" value="<?php echo $feet ?>" name="feea">
                                <input type="hidden" value="<?php echo $btvbalance ?>" name="btccheack">
                                <input type="hidden" value="<?php echo $etvbalance ?>" name="ehtcheack">
                            </div>
                            <?php if($state=='INR') { ?>
                            <div class="col-md-3">
                                <h4>Amount Of INR</h4>
                                <input type="text" class="form-control" name="recbuy_inr" id="totalbtc" required value="<?php echo $total*$data_val['amount']; ?>" readonly>
                                <input type="hidden" value="<?php echo $total; ?>" name="bbt" id="bbt" >
                            </div>
                            <?php }else { ?>
                            <div class="col-md-3">
                                <h4>Amount Of MYR</h4>
                                <input type="text" class="form-control" name="recbuy_myr" id="totaletc" required value="<?php echo $data_val['amount']*$total1; ?>" readonly>
                                <input type="hidden" value="<?php echo $total; ?>" name="bbt" id="bbt">
                            </div>
                             <?php } ?>
                            <div class="col-md-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                             </div>
                             <div class="col-md-4">
                                <h4>Select currency*</h4>
                                <!--<input type="text" class="form-control" name="buy" id="etc" required>
                                <input type="hidden" value="<?php echo $total1; ?>" name="bbut" id="bbut">-->
                                <select class="form-control" required name="currency" id="" readonly>
                                <?php if($state=='INR') { ?>
                                <option value="0">INR</option>
                                <?php }else { ?>
                                <option value="1">MYR</option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h4></h4>
                                <button class="btn btn-block btn-primary btn-continue" type="submit" name="submit" style="margin-top: 38px;padding:  12px;" >Sell <?php if($coin == 0){ echo "BTC"; }else{echo "ETH";}?></button>
                                <input type="hidden" name="button_type" value="0">
                            </div>
    					    <div class="col-md-4">
                            </div>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
        <div class="container-flude">
		    <div class="row">
    	        <div class="col-md-3">
    	        </div> 
			    <div class="col-md-6">
    			    <table class="table table-bordered" style="margin-top: 25px;">
			            <thead>
		                 <tr> <th colspan="2" style="text-align:  center;font-size:  22px;background:  black;color:  white;">Advertisement details</th>  </tr>
		                 <tr>
	                        <th>BUYER Name</th>
	                        <th><?php echo $data_val['holdername']; ?></th>
	                     </tr>
		                </thead>
		                <tbody>
		                    <tr>
		                        <th>Coin Amount</th>
		                        <th><?php echo $data_val['amount']; ?> INR/<?php if($_GET['coin']==0){ echo 'BTC' ; }else {  echo 'ETH';   } ?></th>
		                    </tr>
		                    <tr>
		                        <th>Payment window</th>
		                        <th>8 hours</th>
		                      </tr>  
		                </tbody>
			         </table>
			     </div>
			     <div class="col-md-3">
			     </div>
			 </div>
		</div>
    </div>
