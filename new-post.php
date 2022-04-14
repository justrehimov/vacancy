<?php
include 'cookiemanager.php';
include 'database.php';
include 'databasemanager.php';
isLogin("user");
$company = "";
$error = "";
   if(!empty($_COOKIE['user'])){
       $company = getCompanyById($_COOKIE['user']);
       $myvacancies = getVacancyCountByCompanyId($_COOKIE['user']);
       if(isset($_GET['error'])){
           switch($_GET['error']){
               case "1":
                   $error = "Send all data";
                   break;
                case "2":
                    $error = "Data cannot be empty";
                    break;
                default:
                    header("Location: error.php?error=true&code=0");       
           }
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
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/generallynew.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/generallynew.css">
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/new-post.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./mobile-css/new-post.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js" charset="UTF-8"></script>
    <title>New post</title>
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
        <li>
            <div class="dropdown">
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

<div class="container">
    <form action="addpost.php" method="post">

        <div class="form-row">
            <div class="form-group">
                <label for="inputName">Vacancy name</label>
                <input type="text" name="vacancy" onclick="clearerror()" class="form-control" id="inputName" placeholder="Java Backend Developer">
            </div>
            <div class="form-group col-md-6">
                <label for="inputSalary">Salary</label>
                <input onclick="clearerror()" type="text" name="salary" class="form-control" id="inputSalary" placeholder="1000-2000 or by agreement">
            </div>
            <div class="form-group">
                <label for="inputCategory">Category</label>
                <select onclick="clearerror()" class="custom-select"  name="category" id="inputCategory">
                    <option disabled selected>Category</option>
                    <?php
                        $category = getAllCategory();
                        while($result = mysqli_fetch_array($category)){
                            echo "<option value=$result[ID]>$result[CATEGORY]</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inputWorkmode">Work mode</label>
                <select onclick="clearerror()" class="custom-select" name="workmode" id="inputWorkmode">
                    <option disabled selected>Work mode</option>
                    <?php
                        $workmode = getAllWorkmode();
                        while($result = mysqli_fetch_array($workmode)){
                            echo "<option value=$result[ID]>$result[WORKMODE]</option>";
                        }
                        ?>
                </select>
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputExperience">Experience</label>
                <select onclick="clearerror()" class="custom-select" name="experience" id="inputExperience">
                    <option disabled selected>Experience</option>
                    <?php
                        $experience = getAllExperience();
                        while($result = mysqli_fetch_array($experience)){
                            echo "<option value=$result[ID]>$result[EXPERIENCE]</option>";
                        }
                        ?>
                </select>
            </div>

            <div class="form-group">
                <label for="inputEducation">Education</label>
                <select onclick="clearerror()"  class="custom-select" name="education" id="inputEducation">
                    <option disabled selected>Education</option>
                    <?php
                        $education = getAllEducation();
                        while($result = mysqli_fetch_array($education)){
                            echo "<option value=$result[ID]>$result[EDUCATION]</option>";
                        }
                        ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputAge">Age</label>
                <select onclick="clearerror()"  class="custom-select" name="age" id="inputAge">
                    <option disabled selected>Age</option>
                    <?php
                        $age = getAllAge();
                        while($result = mysqli_fetch_array($age)){
                            echo "<option value=$result[ID]>$result[AGE]</option>";
                        }
                        ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputExpdate">Exp date</label>
                <input onclick="clearerror()"  type="date" min="<?=date("Y-m-d");?>" name="expdate" class="form-control" id="inputExpdate">
            </div>
        </div>

        <div class="form-group wide">
            <label for="editor">Detailed information about the vacancy</label>
            <div id="editor" class="form-control">

            </div>
        </div>
        <div class="form-group wide">
            <label for="editor2">Requirements for vacancy</label>
            <div id="editor2" class="form-control wide">
            </div>
        </div>
        <div class="form-group wide">
            <label onclick="clearerror()"  for="textareaAdress">Adress</label>
            <textarea name="address" class="form-control" id="textareaAdress" rows="4"></textarea>
        </div>
        <div class="form-btn">
            <div class="error-message">
                <span class="error-txt"><?=$error?></span>
            </div>
            <input type="hidden" name="information" id="information">
            <input type="hidden" name="requirements" id="requirements">
            <input type="submit" onclick="setEditorsData(myeditor1,myeditor2,'information','requirements')" name="addpost" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                   value="Add vacancy">
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
<script src="https://kit.fontawesome.com/12df5bbd4f.js" crossorigin="anonymous"></script>
<<script>
    var myeditor1;
    var myeditor2;
    ClassicEditor
        .create(document.querySelector('#editor'),{
            toolbar: [ 'bold','italic','|','bulletedList','|','link','undo', 'redo' ]
        })
        .then(editor => {
            console.log(editor);
            myeditor1 = editor;
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#editor2'),{
            toolbar: [ 'bold','italic','|','bulletedList','|','link','undo', 'redo' ]
        })
        .then(editor2 => {
            console.log(editor2);
            myeditor2 = editor2;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script src="./javascript/main.js"></script>
</body>
</html>
