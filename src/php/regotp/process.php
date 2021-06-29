<?php
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../../register.php?msg=please_register');
}
//Your authentication key
$authKey = "310028AJ2Ve5jk3F5e038e1bP1";
//Multiple mobiles numbers separated by comma
$mobileNumber = $_SESSION['phn'];
//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "madiot";
//Your message to send, Add URL encoding here.
$rndno=rand(1000, 9999);
$message = urlencode("otp number.".$rndno);
//Define route
$route = "route=4";
$country= "91";
//Prepare you post parameters
$postData = array(
'authkey' => $authKey,
'mobiles' => $mobileNumber,
'message' => $message,
'sender' => $senderId,
'route' => $route,
'country' => $country
);
//API URL
$url="http://api.msg91.com/api/sendhttp.php";
// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $postData
//,CURLOPT_FOLLOWLOCATION => true
));
//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//get response
$output = curl_exec($ch);
//Print error if any
if(curl_errno($ch))
{
echo 'error:' . curl_error($ch);
}
curl_close($ch);
$_SESSION['otp']=$rndno;






/*// $message = urlencode("otp number.".$rndno);
$to=$_SESSION['email'];
$subject = "OTP";
$txt = "OTP: ".$rndno."";
$headers = "From: parvathanenim@gmail.com";
mail($to,$subject,$txt,$headers);
// $_SESSION['otp']=$rndno;*/
header( "Location: ../../../regotp.php" );



?>
