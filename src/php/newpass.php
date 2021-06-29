
<?php
include_once('connect.php');
session_start();
if(!isset($_SESSION['aadhaar']))
{
  header('location:../../login.php?msg=please_login');
}



  $new_pass = $_POST["new_pass"];
  $re_pass = $_POST["re_pass"];


  if($new_pass==$re_pass){
    $password_string = $_POST["new_pass"];
    $update_pass = password_hash($password_string, PASSWORD_DEFAULT);

    // $check="UPDATE data set pass='$new_pass' where a_id = '$_SESSION[aadhaar]'"
    // $update_pwd = mysqli_query($conn,$check);


  $update_pwd=mysqli_query($conn,"update data set pass='$update_pass' where a_id = '$_SESSION[aadhaar]'");
    echo "<script>alert('Update Sucessfully'); window.location='../../login.php'</script>";
    // header('location:../../login.php');
  }
  else{
    echo "<script>alert('Your new and Retype Password is not match'); window.location='../../aadhaar.php'</script>";
    // header('location:../../login.php');
  }
