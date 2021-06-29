<?php
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../login.php?msg=please_login');
}

include_once('connect.php');

$check="SELECT * FROM data WHERE a_id = '$_POST[aadhaar]'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs);
$_SESSION['phn'] = $data ['phn_no'];
$_SESSION['email'] = $data ['mail_id'];
$_SESSION['name'] = $data ['name'];
$_SESSION['pass'] = $data ['pass'];
$_SESSION['aadhaar']=$_POST['aadhaar'];

header('location:forgototp/process.php');

  ?>
