<?php
include 'database.php';
include 'fileupload.php';
include 'sendmail.php';
include 'companydata.php';
include 'databasemanager.php';

if($con->connect_error){
    header("Location: error.php?error=1"); //Connection error
    return;
}

if(!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['company']) || !isset($_POST['email']) || !isset($_POST['phone'])
|| !isset($_POST['website']) || !isset($_POST['city']) || !isset($_POST['password']) || !isset($_POST['about']) || !isset($_FILES['logo']) || !isset($_POST['confirmpassword'])) {
  header("Location: register.php?error=1"); //Fields is empty
  return;
}

$name = $_POST['name'];
$surname = $_POST['surname'];
$company = $_POST['company'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website'];
$city = $_POST['city'];
$about = $_POST['about'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$logo = $_FILES['logo'];
$data_date = date("Y.m.d");

if(empty($name) || empty($surname) || empty($company) || empty($email) || empty($phone) || empty($website)
|| empty($city) || empty($password) || empty($logo) || empty($about) || empty($data_date) || empty($confirmpassword)) {
  header("Location: register.php?error=2"); //Data is empty
  return;
}

if($password != $confirmpassword){
  header("Location: register.php?error=4");
  return;
}
$sql = "SELECT COUNT(*) AS COUNT FROM COMPANY WHERE LOWER(EMAIL) = LOWER('$email') AND ACTIVE = 1";
$result = mysqli_query($con,$sql)->fetch_assoc();

if ($result['COUNT'] == 1) {
  header("Location: register.php?error=3"); //Exist email
  return;
}

$hashPassword = password_hash($password,PASSWORD_DEFAULT);
$path = uploadFile('/uploads/',$logo);
$companyClass = new CompanyData(0,$company,$name,$surname,$email,$phone,$hashPassword,$city,$about,$path,$data_date,0,$website);
insertCompany($companyClass);
$code = rand(100000, 999999);
sendCode($email, $code);
session_start();
$_SESSION['code'] = $code;
$_SESSION['email'] = $email;
header("Location: vertification.php"); //Confirm mail

?>