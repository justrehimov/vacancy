<?php
include 'database.php';
include 'sendmail.php';
session_start();
$error = "";

if(isset($_POST['email']) & isset($_POST['sendcode'])) {
    $email = $_POST['email'];
    if(!empty($email)){
        $sql = "SELECT COUNT(*) AS COUNT FROM COMPANY WHERE LOWER(EMAIL) = LOWER('$email') AND ACTIVE = 1";
        $result = mysqli_query($con,$sql)->fetch_assoc();
        if($result['COUNT'] != 0) {
            $code = rand(100000, 999999);
            sendCode($email,$code);
            $_SESSION['code'] = $code;
            $_SESSION['email'] = $email;
            header("Location: forgotpassword.php");
        }
        else{ 
            $error = "Email not found";
        }
    }
    else {
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
    <title>Forgot password</title>
</head>
<body>
<nav class="navbar" id="navbar">
<a href="index.php"><img class="logo" src="./images/logo.png" width="200px"></a>

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
<div class="top-bar" id="topbar">
    <ul class="topbar-menu">
        <li><a href="/index">Home</a></li>
        <li><a href="/vacancies">Vacancies</a></li>
        <li><a href="/login">Login</a></li>
    </ul>
    <div class="social-media-topbar">
        <div class="links">
            <a class="link insta" href="#">
                <div><i class="fab fa-instagram"></i></div><span>Instagram</span>
            </a>
            <a class="link whatsapp" href="#">
                <div><i class="fab fa-whatsapp"></i></div><span>Whatsapp</span>
            </a>
            <a class="link telegram" href="#">
                <div><i class="fab fa-telegram-plane"></i></div><span>Telegram</span>
            </a>
            <a class="link face" href="#">
                <div><i class="fab fa-facebook-f"></i></div><span>Facebook</span>
            </a>
        </div>
    </div>
</div>
<div class="content">
    <h1>Send Vertification Code</h1>
    <form class="register-form" method="post" action="sendcode.php">
        <div class="user-info">
            <input class="input" name="email" onclick="clearerror()" type="email" placeholder="Email">
            <div class="error-message">
                <span class="error-txt" id="error"><?=$error?></span>
            </div>
            <input class="input btn" name="sendcode" type="submit" value="Send code">
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