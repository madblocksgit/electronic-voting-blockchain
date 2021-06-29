<?php
session_start();
include_once('connect.php');

$_SESSION['phn'] = $_POST['phn'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['name'] = $_POST['name'];
$_SESSION['aadhaar']= $_POST['aadhaar'];
$_SESSION['dob']= $_POST['dob'];
$_SESSION['pass'] = $_POST['pass'];
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../register.php?msg=please_register');
}


$check="SELECT a_id FROM data WHERE a_id = '$_POST[aadhaar]'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
       //echo "You already completed your registration please login ";
      echo "<script>alert('You already completed your registration please login'); window.location='../../fpverify.php'</script>";

}

else
{
$check="SELECT phn_no FROM data WHERE phn_no = '$_POST[phn]'";
 $rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
         //echo "You already completed your registration please login ";
          echo "<script>alert('You already completed your registration please login'); window.location='../../fpverify.php'</script>";
}
else{

$email = $_POST['email'];
$check="SELECT mail_id FROM data WHERE mail_id = '$email' ";
$rs = mysqli_query($conn,$check);
$data = mysqli_num_rows($rs);
if($data > 1) {
  // echo "You already completed your registration please login ";
    echo "<script>alert('You already completed your registration please login'); window.location='../../fpverify.php'</script>";
}
else{

header('location: regotp/process.php');
}
}
}
?>
