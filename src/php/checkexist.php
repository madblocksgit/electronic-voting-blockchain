<?php
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../login.php?msg=please_login');
}
include_once('connect.php');

$check="SELECT a_id FROM data WHERE a_id = '$_SESSION[aadhaar]'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);

if($data[0] > 1)

    {
    // header('location:checknotexist.php');
    $check="SELECT * FROM v_count WHERE a_id = '$_SESSION[aadhaar]'";
    $rs = mysqli_query($conn,$check);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    if($data[0] > 1) {
      echo "you alredy completed your voting";
    }

    else
    {

          header('location:logotp/process.php');
    }
}

else
{

    echo "aadhaar no mismatch please register and try again later";
}
?>
