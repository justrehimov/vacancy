<?php
 include 'database.php';
 include 'cookiemanager.php';
 include 'databasemanager.php';
 $loginstyle = "display:inline !important;";
 $profilestyle = "display:none !important;";
 $company = "";
    if(!empty($_COOKIE['user'])){
        $loginstyle = "display:none !important;";
        $profilestyle = "display:inline-block !important;";
        $company = getCompanyById($_COOKIE['user']);
        $myvacancies = getVacancyCountByCompanyId($_COOKIE['user']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/icon.png" type="image/icon type">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/generally.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/generally.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/index.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/index.css">
    <title>2022 Vacancies</title>
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
        <li><a href="vacancylist.php">Vacancies</a></li>
        <li>
        </li>
        <li><a href="new-post.php">Add vacancy</a></li>
        <li><a href="login.php" style="<?=$loginstyle?>">Login</a></li>
        <li>
            <div class="dropdown" style="<?=$profilestyle?>">
                <a><i class="fas fa-user-circle"></i></a>
                <div class="dropdown-content">
                    <div class="account">
                        <div class="img-container"><img class="account-profile" src=".<?=$company['LOGO']?>"></div>
                        <div class="about-user">
                            <span><?=$company['NAME']." ".$company['SURNAME']?></span>
                            <span><?=$company['EMAIL']?></span>
                        </div>
                    </div>
                    <div class="account-menu">
                        <a href="profile.php"><span>My Account</span><i class="fas fa-user"></i></a>
                        <a href="myvacancies.php"><span>My vacancies</span><span><?=$myvacancies?></span></a>
                        <a href="login.php"><span>Logout</span><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>

<div class="content">
    <header class="header">
        <h1>Professional business world</h1>
        <span>You can search and share all kinds of vacancies on this site</span>
    </header>
    <div class="category">
        <h1>Categories</h1>
        <span><?=getAllVacancyCount()?> active vacancies</span>
        <div class="categories">
            <span class="cards">
                <i class="fas fa-code"></i>
                <a href="vacancylist.php?category=1" >Information technologies</a>
            </span>
            <span class="cards">
                <i class="fab fa-uikit"></i>
                <a href="vacancylist.php?category=2">Design and creativity</a>
            </span>
            <span class="cards">
                <i class="fas fa-stethoscope"></i>
                <a href="vacancylist.php?category=3">Medicine and pharmacy</a>
            </span>
            <span class="cards">
                <i class="fas fa-user-graduate"></i>
                <a href="vacancylist.php?category=4">Training and education</a>
            </span>
        </div>
    </div>
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

<script src="https://kit.fontawesome.com/12df5bbd4f.js" crossorigin="anonymous"></script>
<script src="./javascript/main.js"></script>
</body>
</html>