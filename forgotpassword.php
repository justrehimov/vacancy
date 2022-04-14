<?php
include 'database.php';
include 'databasemanager.php';
$error = "";
if(isset($_POST['code']) & isset($_POST['newpassword'])& isset($_POST['confirmpassword'])& isset($_POST['change'])){
    $code = $_POST['code'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    if(!empty($code) & !empty($newpassword) & !empty($confirmpassword)){
        session_start();
        $realcode = $_SESSION['code'];
        $email = $_SESSION['email'];
        if($realcode == $code){
            if($confirmpassword == $newpassword){
                $hashPassword = password_hash($newpassword,PASSWORD_DEFAULT);
                changePassword($hashPassword, $email);
                session_destroy();
                header("Location: login.php");
            }
            else{
                $error = "Password doesn't match";
            }
        }
        else{
            $error = "Code is not true";
        }
    }
    else{
        $error = "Data cannot be empty";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/icon.png" type="image/icon type">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/generally.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/generally.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/login.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/login.css">
    <title>Change password</title>
</head>
<body>
<nav class="navbar" id="navbar">
    <img class="logo" src="./images/logo.png" width="200px">

    <button class="hamburger-btn" id="hamburgerbtn" value="close">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <ul class="navbar-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="vacancylist.php">Vacancies</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>
<div class="content">
    <h1>Change password</h1>
    <form class="register-form" method="post" action="forgotpassword.php">
        <div class="user-info">
            <input class="input" onclick="clearerror()" name="code" type="text" placeholder="Code">
            <input class="input" onclick="clearerror()" name="newpassword" minlength="8" type="password" placeholder="New password">
            <input class="input" onclick="clearerror()" name="confirmpassword" minlength="8" type="password" placeholder="Confirm password">
            <div class="error-message">
                <span class="error-txt" id="error"><?=$error?></span>
            </div>
            <input class="input btn" type="submit" name="change" value="Change password">
        </div>
    </form>
</div>


<footer class="footer">
    <img class="logo" src="./images/logo.png" width="200px">
    <div class="contacts">
        <ul>
            <li><a href="https://goo.gl/maps/VjqUNfaoVtquroC19">Baku,Azerbaijan</a></li>
            <li><a href="tel:+99455873716">+994 (55) 873-71-65</a></li>
            <li><a href="mailto:info@ekadr.az">info@ekadr.az</a></li>
        </ul>
    </div>
    <div class="social-media">
        <div class="links">
            <a class="link insta" href="#">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="link whatsapp" href="#">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a class="link telegram" href="#">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a class="link face" href="#">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="link up" href="#navbar">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
</footer>
<script src="./javascript/main.js"></script>
<script src="https://kit.fontawesome.com/12df5bbd4f.js" crossorigin="anonymous"></script>
</body>
</html>