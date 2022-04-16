<?php
include 'database.php';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/icon.png" type="image/icon type">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/generally.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/generally.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/vacancylist.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/vacancylist.css">
    <title>Vacancy list</title>
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
<form class="search-form" method="get" action="vacancylist.php">
    
        <select class = "custom-select" name="category"  id = "inputCategory">
            <option value="0" selected>Category</option>
            <?php
                $category = getAllCategory();
                while($result = mysqli_fetch_array($category)){
                echo "<option value=$result[ID]>$result[CATEGORY]</option>";
                }
            ?>
        </select>
        
        <input type="search" value="" class="input-search" name="keyword" placeholder="Java developer...">
        <button type="submit" class="btn-submit"><i class="fas fa-search"></i></button>
    </form>
<div class="content">
    <div class="vacancy-list">
        <?php

            $vacancysql = "";

        if(isset($_GET['keyword']) || isset($_GET['category'])){
            $keyword = "";
            $s_category =  $_GET['category'];
            if(!empty($_GET['keyword'])){
                $keyword = $_GET['keyword'];
            }
            if($s_category == 0 & empty($keyword)){
                    $vacancysql = getAllVacancy();
            }else{
                $vacancysql = searchVacancy($keyword, $s_category);
            }             
        } 
        while($result = mysqli_fetch_array($vacancysql)){
            $company = getCompanyById($result['COMPANY_ID']);
            $workmode = getWorkmodeById($result['WORKMODE_ID']);
            $experience = getExperienceById($result['EXPERIENCE_ID']);
        ?>
        <a class="post" target="_blank" href="post.php?postId=<?=$result['ID']?>">
            <img class="company-logo" src=".<?=$company['LOGO']?>">
            <div class="about-post">
                <span><?=$result['VACANCY_NAME']?></span>
                <span><?=$company['COMPANY_NAME']?></span>
                <span><?=$result['SALARY']?></span>
            </div>
            <div class="additional-info">
                <span>Workmode: <?=$workmode['WORKMODE']?></span>
                <span>Experience: <?=$experience['EXPERIENCE']?></span>
                <span>EXP:<?=$result['EXP_DATE']?></span>
            </div>
        </a>
            
       <?php } ?>
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