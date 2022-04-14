<?php
$error = "";
include 'database.php';
include 'databasemanager.php';
if(isset($_GET['error'])){
    $error = $_GET['error'];
    switch($error){
        case "1":
            $error = "Data cannot be empty";
            break;
        case "2":
            $error = "Data cannot be empty";
            break; 
        case "3":
            $error = "This email already registered";
            break;
        case "4":
            $error = "Password doesn't match confirm password";
            break;     
        default:
            header("Location:error.php?error=true&code=0");
            break;        
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
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/register.css">
    <title>Register</title>
</head>
<body>
<nav class="navbar" id="navbar">
<a href="index.php"><img class="logo" src="./images/logo.png" width="200px"></a>
    <ul class="navbar-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="vacancylist.php">Vacancies</a></li>
        <li><a href="new-post.php">Add vacancy</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>
    <div class="content">
          <h1>Register page</h1>
          <form class="register-form" method="post" action="signup.php" enctype="multipart/form-data">
              <div class="user-info">
                <input class="input" onclick="clearerror()" name="name" type="text" required placeholder="Name">
                <input class="input" onclick="clearerror()"  name="surname" type="text" required placeholder="Surname">
                <input class="input" onclick="clearerror()"  name="company" type="text" required placeholder="Company name">
                <input class="input" onclick="clearerror()"  name="email" type="email" required placeholder="Email">
                <input class="input" onclick="clearerror()"  name="phone" type="tel" required placeholder="Phone">

                <select name="city" class="input" id="input">
                    <option disabled selected>City</option>
                    <?php
                        $citysql = getAllCity();
                        while($result = mysqli_fetch_array($citysql)){
                            echo "<option value=$result[ID]>$result[CITY]</option>";
                        }
                        ?>
                </select>

                <input class="input" onclick="clearerror()"  name="website" type="url" placeholder="Website">
                <div class="passconatiner">
                <input class="input" onclick="clearerror()"  name="password" required type="password" minlength="8" placeholder="Password">
                <input class="input" onclick="clearerror()"  name="confirmpassword" required type="password" minlength="8" placeholder="Confirm password">
                </div>
                <label for="upload" class="input wrapper" id="wrapper"  data-text="Select logo">
                    <input id="upload" onclick="clearerror()"  name="logo" required onchange="checkfile()" type="file" class="field" accept="image/*">
                </label>
              </div>
              <textarea class="text" onclick="clearerror()" required  name="about" placeholder="About the company" rows="5"></textarea>
              <div class="register-footer">
                  <div class="error-message">
                      <span class="error-txt" id="error"><?=$error?></span>
                  </div>
                  <input class="input btn" name="registerbtn" type="submit" value="Register">
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