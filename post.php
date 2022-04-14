<?php
include 'database.php';
include 'databasemanager.php';
$loginstyle = "display:inline !important;";
$profilestyle = "display:none !important;";
$company = "";
$vacancy = "";
$v_company = "";
$city = "";
$experience = "";
$category = "";
$education = "";
$age = "";
$workmode = "";
   if(!empty($_COOKIE['user'])){
       $loginstyle = "display:none !important;";
       $profilestyle = "display:inline-block !important;";
       $company = getCompanyById($_COOKIE['user']);
       $myvacancies = getVacancyCountByCompanyId($_COOKIE['user']);
   }
   if(isset($_GET['postId'])){
       $postId = $_GET['postId'];
       if(!empty($postId)){
        $vacancy = getVacancyById($postId);
        if(empty($vacancy)){
            header("Location: error.php?error=true&code=2");
        }
        else{
            $v_company = getCompanyById($vacancy['COMPANY_ID']);
            $workmode = getWorkmodeById($vacancy['WORKMODE_ID']);
            $education = getEducationById($vacancy['EDUCATION_ID']);
            $experience = getExperienceById($vacancy['EXPERIENCE_ID']);
            $age = getAgeById($vacancy['AGE_ID']);
            $category = getCategoryById($vacancy['CATEGORY_ID']);
            $city = getCityById($v_company['CITY_ID']);
        }
       }
       else{
           header("Location: error.php?error=true&code=2");
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
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/post.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/post.css">
    <title><?=$vacancy['VACANCY_NAME']?></title>
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
<div class="top-bar" id="topbar">
    <ul class="topbar-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="./vacancylist.php">Vacancies</a></li>
        <li><a href="./new-post.php">Add vacancy</a></li>
        <li><a href="./register.php">Register</a></li>
        <li><a href="./login.php">Login</a></li>
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
    <h1><?=$vacancy['VACANCY_NAME']?></h1>
    <div class="post-header">
        <div class="post-item">City: <span><?=$city['CITY']?></span></div>
        <div class="post-item">Work mode: <span><?=$workmode['WORKMODE']?></span></div>
        <div class="post-item">Experience: <span><?=$experience['EXPERIENCE']?></span></div>
        <div class="post-item">Category: <span><?=$category['CATEGORY']?></span></div>
        <div class="post-item">Company:<span><?=$v_company['COMPANY_NAME']?></span></div>
        <div class="post-item">Age: <span><?=$age['AGE']?></span></div>
        <div class="post-item">Salary: <span><?=$vacancy['SALARY']?></span></div>
        <div class="post-item">Phone: <span><?=$v_company['PHONE']?></span></div>
        <div class="post-item">Email: <a href="mailto:<?=$v_company['EMAIL']?>"><?=$v_company['EMAIL']?></a></div>
        <div class="post-item">Education: <span><?=$education['EDUCATION']?></span></div>
        <div class="post-item">Post date: <span><?=$vacancy['DATA_DATE']?></span></div>
        <div class="post-item">Expiration date: <span><?=$vacancy['EXP_DATE']?></span></div>
    </div>
    <div class="about-post">
        <div class="about information">
            <h2>About the vacancy</h2>
            <div class="info"><?=$vacancy['INFORMATION']?></div>
        </div>
        <div class="about requirements">
            <h2>Requirements</h2>
            <div class="info"><?=$vacancy['REQUIREMENTS']?></div>
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