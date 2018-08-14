<?php 
include  "config.php";

$ind=mysqli_query($con,"select * from buyer");

while($indfetch=mysqli_fetch_array($ind)){
    
    $co=$indfetch['code'];

$innd=mysqli_query($con,"select * from transaction where tid='$co' AND buyer_status='1' AND seller_status='1' AND admin_status='success'");

while($inndfetch=mysqli_fetch_array($innd)){
    
    $chid=$inndfetch['tid'];
    
    mysqli_query($con,"update buyer set status='1' where code='$chid'");
}
}
$session_id= $_SESSION['useremail']; 
$conc=mysqli_query($con,"select * from register where email='$session_id'");
     $concfetch=mysqli_fetch_array($conc);
     $contrry=$concfetch['country'];
     
 $data=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail LEFT JOIN buyer ON bank_detail.tid = buyer.code where buyer.type = 0 and buyer.coin_type = 0 and buyer.status='' and bank_detail.addvert = 'addver'   and buyer.email  !='$session_id'");
 $data1=mysqli_query($con,"SELECT bank_detail.*, buyer.* from bank_detail LEFT JOIN buyer ON bank_detail.tid = buyer.code where buyer.type = 1 and buyer.coin_type = 0 and buyer.status='' and bank_detail.addvert = 'addver'  and buyer.email !='$session_id'");

?>

<?php 

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

$_SESSION['inrbtc']=$btc;

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

$_SESSION['myrbtc']=$eth;


$btcadd=mysqli_query($con,"select * from `add_btc`");
$addfetch=mysqli_fetch_array($btcadd);
 $btc_buy=$addfetch['btc_buy'];
 $btc_sell=$addfetch['btc_sell'];

$finalbtcBuy=$btc+$btc_buy;
$finalbtcSell=$btc+$btc_sell;

$finalMYRBuy=$eth+$btc_buy;
$finalMYRSell=$eth+$btc_sell;


$show=mysqli_query($con,"select * from register where email='$session_id'");

$fetchshow=mysqli_fetch_array($show);
 $state=$fetchshow['country'];

?>

<section class="third">
<div style="background-color: #000000b5;padding-bottom: 44px;">
<div class="container">
    <div class="row">
    <div class="col-md-12 ">
 
        <div class="col-md-6" style="
    margin-top: 41px;
">
             <div class="sec-1"style="
    padding-top: 0px !important;
    margin-top: -33px !important;
    margin-bottom: 56px !important;
    text-align:  center;
    padding-right: 85px;
">
        <h2>
            PEER TO PEER<br>
BITCOIN EXCHANGE
            </h2>
            <h4>FAST - SAFE - SIMPLE

</h4>
        </div>
            <div class="col-md-3" style="
    margin-left: 39px;
">
        <?php if($state=='INR') { ?>
                <strong class="text-success"><?php echo $finalbtcBuy;  ?> INR </strong>
                <?php } 
                else if($state=='MYR') { ?>
                           <strong class="text-success"> <?php echo $finalMYRBuy;  ?> MYR</strong>
                <?php }
                else{ ?> 
                                   <strong class="text-success"><?php echo $finalbtcBuy;  ?> INR / <?php echo $finalMYRBuy;  ?> MYR </strong>
                <?php } ?>
                <br>
                <a class="btn btn-success" href="buy.html?ccoin=BTC" style="
    padding: 10px 26px 10px 26px;
">Buy Now</a>  
            </div>
             
              
           <div class="col-md-3 sellbtn" style="
    margin-left: 101px;
">
       
               <?php if($state=='INR') { ?>
                <strong class="text-success"><?php echo $finalbtcSell;  ?> INR </strong>
                <?php } 
                else if($state=='MYR') { ?>
                           <strong class="text-success"> <?php echo $finalMYRSell;  ?> MYR</strong>
                <?php } 
                else{ ?> 
                                   <strong class="text-success"><?php echo $finalbtcSell;  ?> INR / <?php echo $finalMYRSell;  ?> MYR </strong>
                <?php } ?>
                <br>
                <a class="btn btn-danger" href="buy.html?ccoin=BTC" style="
    padding: 10px 26px 10px 26px;
">Sell Now</a>
            </div>
            </div>
           
            
     
        
        
        </div>
        <!-- <diiv class="col-md-6">
        <img src="assest/images/12.jpg" width="615" height="340" style="
    margin-top: -24px;
">
        </diiv>-->
    </div>
    </div>
    </div>
</section>  

<?php if(isset($_SESSION['useremail'])){ ?>

    <div class="container" style="background-color:#dfeffe; margin-top:50px; height:150px;">
        <div class="row" style="padding-top:20px;">
        <div class="text-center">
            <?php $ern=mysqli_query($con,"select * from reffral_amount"); 
                $ernfetch=mysqli_fetch_array($ern); ?>
            <span style="font-size:18px; color:#3d94e6;"><b>Instantly earn <?php echo $ernfetch['amount'] ?> BTC for every one of your friends who joins ragiantex.Share this Promocode:</b></span>
        </div>
        </div>
        <div class="row"> 
        <div class="text-center" style="padding-top:10px;">
             <?php $ernmal=mysqli_query($con,"select * from register where email='$session_id'"); 
                $ernmalfetch=mysqli_fetch_array($ernmal); ?>
            <strong style="font-size:18px; color:#d9534f;">Your Promocode = <?php echo $ernmalfetch['reffral_code']; ?></strong>
             
        </div>
    </div>
   
</div>

<?php } ?>


<div class="container">

<div class="alert alert-info hide"><div class="user-referral-program referral-landing">
    <div class="text-center prelude"><span><span><!-- react-text: 56 -->Instantly earn <!-- /react-text --><b>4,500.00 INR</b><!-- react-text: 58 --> for every one of your friends who joins Remitano.<!-- /react-text --></span></span><span>Share this link:</span></div><div class="text-center"><a class="btn btn-primary btn-sm" href="/in/login">Login to get referral link</a></div></div><p class="text-center"><a href="/in/referral_program">Find out more</a></p></div>
</div>
    
<section>
    <div class="container">
        <div class="row" style="
    margin-top: 25px;
">
            <div class="col-md-6">
<h3>LIST OF SELLERS</h3>
       <!-- <div class="cntr">
  <input class="hidden-xs-up" id="cbx11" name="fld[]" type="checkbox" value="1" style="
    display:  none;
">
                        <label class="cbx" for="cbx11"></label>
                        <label class="lbl" for="cbx11">&nbsp;&nbsp;Show offline sellers</label>
                        <div class="clearfix"></div>
</div>-->
   
        
    <div class="main">
    <ul>
        <?php
                while($fetch_data=mysqli_fetch_array($data1))
                {
                    
        ?>
        <li class="offer"><div class="offer-wrapper sell-offer null offer-345601"><div class="row"><div class="col-xs-12 col-sm-9 text-left"><a class="offer-body-meta" href="#"><div class="offer-body"><strong class="offer-price text-success"><span><?php echo $fetch_data['amount']; ?></span><!-- react-text: 688 -->/<!-- /react-text --><span class="text-btc-color">BTC</span></strong><span> via </span><span><span><?php echo $fetch_data['bankname']; ?></span><span><!-- react-text: 694 --> <!-- /react-text --><!-- react-text: 695 -->IMPS/RTGS/NEFT Bank Transfer<!-- /react-text --></span></span></div><div class="offer-meta"> <!-- react-text: 698 --><!-- /react-text --><!-- react-text: 699 --> <!-- /react-text --> <!-- react-text: 702 --> <!-- /react-text --></strong></div></a><div class="offer-meta"><div class="offer-author"><a href="/in/profile/ashuvicky"><strong class="offer-item-username"><span class="text-gray icon-globe-new"></span><span><?php echo $fetch_data['holdername']; ?></span></strong></a><!-- react-text: 710 --> <!-- /react-text --><em class="speed-badge badge badge-success">quick seller</em></div></div></div><div class="col-sm-3 text-right hidden-xs"><a class="btn btn-default" href="btcbby.html?aa=<?php echo $fetch_data['code'];  ?>">Buy</a></div></div></div></li>
        <?php
                }
        ?>
        <div class="hide"><ul class="pagination-sm pagination"><li class="pagination-prev disabled"><a tabindex="0">Previous</a></li><li class="hidden"><a tabindex="0" aria-label="Page 1 is your current page" aria-current="page">1</a></li><li class="pagination-next"><a tabindex="0">Next</a></li></ul></div>
        <hr>
        </ul>
    </div>
              </div>
              <div class="col-md-6">
        <h3>LIST OF BUYERS</h3>
       <!--<div class="cntr">
  <input class="hidden-xs-up" id="cbx111" name="fld[]" type="checkbox" value="1" style="
    display:  none;
">
                        <label class="cbx" for="cbx111"></label>
                        <label class="lbl" for="cbx111">&nbsp;&nbsp;Show offline sellers</label>
                        <div class="clearfix"></div>
</div>-->
   
    <div class="main">
    <ul>
        <?php 
                while($fetch_data1=mysqli_fetch_array($data))
                { 
                    
        ?>
        <li class="offer"><div class="offer-wrapper sell-offer null offer-345601"><div class="row"><div class="col-xs-12 col-sm-9 text-left"><a class="offer-body-meta" href="#"><div class="offer-body"><strong class="offer-price text-success"><span><?php echo $fetch_data1['amount']; ?> </span><!-- react-text: 688 -->/<!-- /react-text --><span class="text-btc-color">BTC</span></strong><span> via </span><span><span><?php echo $fetch_data1['bankname']; ?></span><span><!-- react-text: 694 --> <!-- /react-text --><!-- react-text: 695 -->IMPS/RTGS/NEFT Bank Transfer<!-- /react-text --></span></span></div><div class="offer-meta"><!-- react-text: 698 --><!-- /react-text --><!-- react-text: 699 --> <!-- /react-text --><strong> <!-- react-text: 702 --> <!-- /react-text --></strong></div></a><div class="offer-meta"><div class="offer-author"><a href="/in/profile/ashuvicky"><strong class="offer-item-username"><span class="text-gray icon-globe-new"></span><span><?php echo $fetch_data1['holdername']; ?></span></strong></a><!-- react-text: 710 --> <!-- /react-text --><em class="speed-badge badge badge-success">quick buyer</em></div></div></div><div class="col-sm-3 text-right hidden-xs"><a class="btn btn-default" href="btcsell.html?bb=<?php echo $fetch_data1['code']; ?>">Sell</a></div></div></div></li>
         <?php
                } 
         ?>
           <!--<div class=""><ul class="pagination-sm pagination"><li class="pagination-prev disabled"><a tabindex="0">Previous</a></li><li class="hidden"><a tabindex="0" aria-label="Page 1 is your current page" aria-current="page">1</a></li><li class="pagination-next"><a tabindex="0">Next</a></li></ul></div>-->
        <hr>
        </ul>
    </div>
        <!--<span>Want better price?</span>
        <a class="btn btn-primary btn-create-offer" href="/in/offers/create?type=sell">Create advertisement</a>-->
           </div>
          </div>
        </div>
</section>

