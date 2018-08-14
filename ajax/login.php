<?php
include('config.php');

 $email = $_POST['email'];
 $pass = $_POST['pass'];


    //echo "select * from `register` where email='$email' AND password='$pass'"; die;
    $reg=mysqli_query($con,"select * from `register` where email='$email' AND password='$pass'");
  
    
    $regnnum=mysqli_num_rows($reg);
    
    $regfetch=mysqli_fetch_array($reg);
    //print_r($regfetch); die();
   $status=$regfetch['kyc_status'];
    $email_status=$regfetch['status']; 
   
   if($email_status== "pending"){
            
            //die("saklnhdcjks");
            session_destroy();
            echo "Please verify your email";
            exit();
            //echo "<script>window.location.hf=re'ind_3.php'</script>";
            
        }
        
    
    if($regnnum==1){
        
        $_SESSION['useremail']=$email;
        $_SESSION['user_id']=$regfetch['sno'];
        $_SESSION['btc_add']=$regfetch['btcaddress'];
        $_SESSION['eth_add']=$regfetch['ethaddress'];
        
        $_SESSION['vvi']=$email;
        
        if($status== 0){
           // echo "select * from kyc_verification where user_email =".$email; die;
            $regg = mysqli_query($con,"select * from kyc_verification where user_email ='$email'");
            $reggfetch=mysqli_fetch_array($regg);
            $dtfet=$reggfetch['status'];
            $reggnum=mysqli_num_rows($regg);
            if($reggnum == 0){
                
                echo "upload kyc";
                exit();
                //echo "<script>window.location.href='kyc.php'</script>";
            }
            
            else{
            if($dtfet == 0)
            {
             unset($_SESSION['vvi']);
                echo "Your KYC status is pending try again..";
                exit();
                //echo "<script>window.location.href='ind_3.php'</script>";
            
            }else if($dtfet == 1)
            {
                 echo "success";
                 exit();
                 //echo "<script>window.location.href='index.php'</script>";
            }
            else{
                unset($_SESSION['vvi']);
                echo "Your KYC verification rejected please do again..";
                exit();
                //echo "<script>window.location.href='kyc.php'</script>";
                
            }
            }
        }
        elseif($status== 2){
           
           unset($_SESSION['vvi']);
                echo "Your KYC verification rejected please do again..";
                exit();
                //echo "<script>window.location.href='kyc.php'</script>";
          
            
        }
        
        else{ 
             //echo "<script>window.location.href='index.php'</script>";
             echo "success";
             exit();
        }
        
    }
    else{
        
         //echo "<script>alert('Email And Password Not Match')</script>";
           echo "Email And Password Not Match";
           exit();
    //header("location:ind_3.php");
    
    //echo '<script>window.location.href="ind_3.php"</script>';

    
    }
   
    





?>