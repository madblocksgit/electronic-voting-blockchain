<?php
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../../login.php?msg=please_login');
}
$rno=$_SESSION['otp'];
$urno=$_POST['otpvalue'];
if(!strcmp($rno,$urno))
{
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$phone=$_SESSION['phn'];
// Create connection
// $sql = "INSERT INTO quote (name, email, phone)
// VALUES ('$name', '$email', '$phone')";
// if (mysqli_query($conn, $sql))
 {
$authKey = "210494AjY3MdVoXsq5ad5edb2";
$mobileNumber = $phone;
//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "ABCDEF";
//Your message to send, Add URL encoding here.
$message = urlencode("Thank u Your Verification is completed");
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
header( "Location: ../../../resetpass.php" );
}

}
?>
