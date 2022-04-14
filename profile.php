<?php
include 'cookiemanager.php';
include 'databasemanager.php';
include 'database.php';
include 'companydata.php';
isLogin('user');
$company = "";
$error = "";
 if(!empty($_COOKIE['user'])){
     $company = getCompanyById($_COOKIE['user']);
 }
 if(isset($_GET['error'])){
     switch($_GET['error']){
         case "1":
            $error = "Data cannot be empty";
            break;
         case "2":
            $error = "Choose the photo" ;  
            break;
        case "3":
            $error = "Cannot update the photo" ;  
            break;   
        default:
            header("Location: error.php?error=true&code=0");    
     }
 }
 if(isset($_FILES['logo']) & isset($_POST['updatephoto'])){
     $file = $_FILES['logo'];
     $size = $_FILES['logo']['size'];
     if(!empty($file & $size>0)){
        $success = updatePhoto('/uploads/',$file,$_COOKIE['user']);
        if(!$success){
            header("Location: profile.php?error=3"); 
        }
        else{
            header("Location: profile.php"); 
        }
     }
     else{
        header("Location: profile.php?error=2");
     }
 }
 if(isset($_POST['name']) & isset($_POST['surname']) & isset($_POST['company']) & isset($_POST['phone'])
 & isset($_POST['website']) & isset($_POST['city']) & isset($_POST['about']) & isset($_POST['update'])){
     $name = $_POST['name'];
     $surname = $_POST['surname'];
     $companyName = $_POST['company'];
     $city = $_POST['city'];
     $phone = $_POST['phone'];
     $website = $_POST['website'];
     $about = $_POST['about'];

     if(!empty($name) & !empty($surname) & !empty($companyName) & !empty($phone) & !empty($city) & !empty($website) & !empty($about)){
         $companyData = new CompanyData($_COOKIE['user'],$companyName,$name,$surname,null,$phone,null,$city,$about,null,null,null,$website);
         updateCompany($companyData);
         header("Location: profile.php");
     }
     else{
        header("Location: profile.php?error=1");
     }
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
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/profile.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./desktop-css/profile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"/>
    <title>Profile</title>
</head>
<body>
<div class="container rounded bg-white mt-4 mb-4">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src=".<?=$company['LOGO']?>">
                <span class="font-weight-bold mt-2"><?=$company['NAME']." ".$company['SURNAME']?></span><span class="text-black-50 mt-1"><?=$company['EMAIL']?></span>
                <form method="post" action="profile.php" enctype="multipart/form-data">
                <div class="form-row mt-3">
                    <label for="upload">
                        <input type="file" id="upload" accept="image/*" name="logo" style="z-index: -5;width: 0rem;">
                        <div class="btn btn-primary">Upload photo</div>
                    </label>
                    <input class="btn btn-primary" name="updatephoto" type="submit" value="Save">
                </div>
                </form>
                <span class="mt-5 btn"><a href="index.php">Back to home</a></span>
            </div>
        </div>
        <div class="col-md-9 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form method="post" action="profile.php">
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" name="name" placeholder="Name" value="<?=$company['NAME']?>"></div>
                    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" name="surname" value="<?=$company['SURNAME']?>" placeholder="Surname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Company name</label>
                        <input type="text" name="company" class="form-control" placeholder="Company name" value="<?=$company['COMPANY_NAME']?>">
                    </div>
                    <div class="col-md-12"><label class="labels">City</label>
                        <select name="city" class="form-select">
                            <option value="<?=$company['CITY_ID']?>"><?=getCityById($company['CITY_ID'])['CITY']?></option>

                                <?php
                                $citysql = getAllCity();
                                while($result = mysqli_fetch_array($citysql)){
                                    if($result['ID'] != $company['CITY_ID'])
                                    echo "<option value=$result[ID]>$result[CITY]</option>";
                                }
                                ?>

                        </select>
                    </div>

                    <div class="col-md-12"><label class="labels">Phone</label><input type="text" name="phone" class="form-control" placeholder="Phone" value="<?=$company['PHONE']?>"></div>
                    <div class="col-md-12"><label class="labels">Website</label><input type="text" name="website" class="form-control" placeholder="Website" value="<?=$company['WEBSITE']?>"></div>
                    <div class="col-md-12">
                        <label class="labels">About</label>
                        <textarea class="form-control" placeholder="About company" name="about" rows="4"><?=$company['ABOUT_COMPANY']?></textarea>
                    </div>
                </div>
                <div class="mt-3 text-right">
                    <div class="error-message">
                        <span class="error-txt" id="error"><?=$error?></span>
                    </div>
                    <button class="btn btn-primary profile-button" name="update" type="submit">Save Changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div
<script src="./javascript/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
