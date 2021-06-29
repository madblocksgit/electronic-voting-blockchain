<?php

include_once('connect.php');
// include_once('store.php');
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../login.php?msg=please_login');
}
$aadhaar=$_SESSION["aadhaar"];


$query2 =  "INSERT INTO v_count(a_id,c_no)
                VALUES ('$aadhaar','2')";


if (!mysqli_query($conn,$query2))
{
    echo("Error description: " . mysqli_error($conn));
}
else{

    header('location:../../thank.php');
}

?>
