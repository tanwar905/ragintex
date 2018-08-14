<?php
include('config.php');
$session_id= $_SESSION['useremail']; 
if($session_id == '')
{
    echo 'You are not autherised to access Please login';
    die();
    exit();
}
if(isset($_GET['coin']))
{
$coin = $_GET['coin'];
$c= $_GET['c'];
}else
{
    $coin = 0;
    $c= $_GET['c'];
}

if(isset($_GET['type']))
{
$type = $_GET['type'];
if($type == "sell")
{
    $type1 = 1;
}else{
    $type1 = 0;
}

}
//echo $type; die;
?>
<?php
$email=$_SESSION['useremail'];


   
    $vv = 1;
    $emaill=$_SESSION['useremail'];
    $user_id=$_SESSION['user_id'];
    
    //extract($_REQUEST);
    
    $buy = $_REQUEST['coinAmt'];
    $btcIn = $_REQUEST['receivedIn'];
    $recbuy = $_REQUEST['address'];
    
    $rcode=rand(121,98987);
    $_SESSION['buy_code'] = $rcode;
    $tpe=$_REQUEST['button_type1'];
    //echo "INSERT INTO `buyer` ( `email`, `amount`, `address`,`code`,`type`,`user_id`,`payment_method`,`coin_type`) VALUES ( '$emaill', '$buy', '$recbuy','$rcode','$tpe','$user_id','$btcIn',$coin)"; die;
 mysqli_query($con,"INSERT INTO `buyer` ( `email`, `amount`, `address`,`code`,`type`,`user_id`,`payment_method`,`coin_type`) VALUES ( '$emaill', '$buy', '$recbuy','$rcode','$tpe','$user_id','$btcIn',$coin)");

 $data=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail INNER JOIN buyer ON bank_detail.tid = buyer.code where buyer.type = 0 and buyer.amount = '$buy' and buyer.coin_type ='$coin' and buyer.email !='$emaill'");
 $data1=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail INNER JOIN buyer ON bank_detail.tid = buyer.code where buyer.type = 0 and buyer.amount = '$buy' and buyer.coin_type ='$coin' and buyer.email !='$emaill'");
 
// echo "SELECT bank_detail.*, buyer.* from bank_detail INNER JOIN buyer ON bank_detail.tid = buyer.code where buyer.type = 0 and buyer.amount = '$buy' and buyer.coin_type ='$coin' and buyer.email !='$emaill'"; die;
 


?>
<section>
    <div class="container">
        <div class="row" style="
    margin-top: 25px;
">
            <div class="col-md-12">
                <?php $data_fetch11=mysqli_fetch_array($data1); if(!empty($data_fetch11)){?>
<h3><?php if(isset($vv) && $vv == 0){?>LIST OF SELLERS<?php }elseif(isset($vv) && $vv == 1){ ?>LIST OF Buyers<?php }  ?></h3>
    <div class="main">
    <ul><?php
        while($data_fetch = mysqli_fetch_array($data))
         { 
		?>				  
         <li class="offer"><div class="offer-wrapper sell-offer null offer-345601"><div class="row"><div class="col-xs-12 col-sm-9 text-left"><a class="offer-body-meta" href="#"><div class="offer-body"><strong class="offer-price text-success"><span><?php echo $data_fetch['amount']; ?> INR</span><!-- react-text: 688 -->/<!-- /react-text --><span class="text-btc-color">BTC</span></strong><span> via </span><span><span><?php echo $data_fetch['bankname']; ?></span><span><!-- react-text: 694 --> <!-- /react-text --><!-- react-text: 695 -->IMPS/RTGS/NEFT Bank Transfer<!-- /react-text --></span></span></div><div class="offer-meta"><span>Maximum</span><!-- react-text: 698 -->:<!-- /react-text --><!-- react-text: 699 --> <!-- /react-text --><strong><span>0.0029798</span><!-- react-text: 702 --> <!-- /react-text --><span>BTC</span></strong></div></a><div class="offer-meta"><div class="offer-author"><a href="#"><strong class="offer-item-username"><span class="text-gray icon-globe-new"></span><span><?php echo $data_fetch['holdername']; ?></span></strong></a><!-- react-text: 710 --> <!-- /react-text --><em class="speed-badge badge badge-success"<?php if(isset($vv) && $vv == 0){?><a class="btn btn-default" href="#">quick seller</a><?php }elseif(isset($vv) && $vv == 1){ ?><a class="btn btn-default" href="#">quick buyer</a><?php }  ?></em></div></div></div><div class="col-sm-3 text-right hidden-xs"><?php if(isset($vv) && $vv == 0){?><a class="btn btn-default" href="btcbby.php?aa=<?php echo $data_fetch['code']; ?>">Buy Now</a><?php }elseif(isset($vv) && $vv == 1){ ?><a class="btn btn-default" href="btcsell.html?bb=<?php echo $data_fetch['code']; ?>">Sell To</a><?php }  ?></div></div></div></li>
        <?php } ?>
        <div class="hide"><ul class="pagination-sm pagination"><li class="pagination-prev disabled"><a tabindex="0">Previous</a></li><li class="hidden"><a tabindex="0" aria-label="Page 1 is your current page" aria-current="page">1</a></li><li class="pagination-next"><a tabindex="0">Next</a></li></ul></div>
        <hr>
        </ul>
    </div>
   <?php }else{ ?>
    <div id="addver">
						   
						    
						No one find You can <a href="buy_info.html?coin=<?php echo $coin; ?>&type=<?php echo $type; ?>&c=<?php echo $c; ?>&ss=addver"><button class="btn btn-block btn-primary btn-continue" type="submit" style="margin-top: 38px;width:  35%;padding:  12px;">Create Advertisement</button></a>
						</div>
   
              </div>
              <?php } ?>
          </div>
        </div>
</section>
