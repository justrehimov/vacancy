<?php
include 'cookiemanager.php';
include 'databasemanager.php';
include 'vacancydata.php';
include 'sendmail.php';
isLogin('user');

if(!isset($_GET['editId']) || empty($_GET['editId'])){
    header("Location: error.php?error=true&code=0");
    return; 
}
 
if(isset($_POST['vacancy']) & isset($_POST['salary']) & isset($_POST['category']) & isset($_POST['workmode']) & isset($_POST['experience']) & isset($_POST['education'])
& isset($_POST['expdate']) & isset($_POST['age']) & isset($_POST['information']) & isset($_POST['requirements']) & isset($_POST['address']) & isset($_POST['editId'])) {

    $vacancyName = $_POST['vacancy'];
    $salary = $_POST['salary'];
    $categoryId = $_POST['category'];
    $workmodeId = $_POST['workmode'];
    $ageId = $_POST['age'];
    $experienceId = $_POST['experience'];
    $educationId = $_POST['education'];
    $expirationDate = $_POST['expdate'];
    $information = $_POST['information'];
    $requirements = $_POST['requirements'];
    $address = $_POST['address'];
    $editId = $_POST['editId'];

    if(empty($vacancyName) || empty($salary) || empty($categoryId) || empty($workmodeId) || empty($experienceId) || empty($educationId)
        || empty($expirationDate) || empty($information) || empty($requirements) || empty($address) || empty($ageId) || empty($editId)) {
        header("Location: edit.php?error=1");
    }
    $vacancyData = new VacancyData($editId, 3, NULL, NULL, $vacancyName, $salary, $categoryId, $workmodeId, $experienceId, $educationId, $ageId, $expirationDate, $information, $requirements, $address);
    if(updateVacancyById($editId,$vacancyData)){
        header("Location: myvacancies.php");
        return;
    }
}
if(isset($_GET['error']) & !empty($_GET['error'])){
    switch($_GET['error']){
        case "1":
            $error = "Data cannot be empty";
            break;
        default:
            header("Location: error.php?error=true&code=0"); 
    }
}
$error = "";
$vacancy = getEditableVacanyById($_GET['editId']);
$company = getCompanyById($_COOKIE['user']);
if(empty($vacancy) || $vacancy['COMPANY_ID'] != $_COOKIE['user']){
    header("Location: error.php?error=true&code=3");
    return;   
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"/>
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js" charset="UTF-8"></script>
    <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/edit.css">
    <link rel="stylesheet" media="screen and (max-width: 767px)" href="./desktop-css/edit.css">
    <title>Edit vacancy</title>
</head>
<body>
<div class="container rounded bg-white mt-4 mb-4">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5 mb-1" width="150px" src=".<?=$company['LOGO']?>">
                <span class="font-weight-bold"><?=$company['NAME']." ".$company['SURNAME']?></span>
                <span class="text-black-50"><?=$company['EMAIL']?></span>
                <span class="mt-5"><a href="myvacancies.php">Back to your vacancies</a></span>
            </div>
        </div>


        <div class="col-md-9 border-right" id="container">
            <form method="post" action="edit.php?editId=<?=$_GET['editId']?>">
                <div class="row m-1 mt-4">
                    <div class="col">
                        <label for="vacancy" class="form-label">Vacancy name</label>
                        <input type="text" name="vacancy" value="<?=$vacancy['VACANCY_NAME']?>" class="form-control" id="vacancy" placeholder="Vacancy name">
                    </div>
                    <div class="col">
                        <label for="salary" class="form-label">Salary</label>
                        <input type="text" name="salary" value="<?=$vacancy['SALARY']?>" class="form-control" id="salary" placeholder="Salary">
                    </div>
                </div>

                <div class="row m-1 mt-4">
                    <div class="col">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-control">
                        <?php
                            $v_category = getCategoryById($vacancy['CATEGORY_ID']);
                            $category = getAllCategory();
                            echo "<option value=$v_category[ID]>$v_category[CATEGORY]</option>";
                            while($result = mysqli_fetch_array($category)){
                                if($result['ID'] != $vacancy['CATEGORY_ID'])
                                    echo "<option value=$result[ID]>$result[CATEGORY]</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="workmode" class="form-label">Work mode</label>
                        <select id="workmode" name="workmode" class="form-control">
                        <?php
                            $v_workmode = getWorkmodeById($vacancy['WORKMODE_ID']);
                            $workmode = getAllWorkmode();
                            echo "<option value=$v_workmode[ID]>$v_workmode[WORKMODE]</option>";
                            while($result = mysqli_fetch_array($workmode)){
                                if($result['ID'] != $vacancy['WORKMODE_ID'])
                                    echo "<option value=$result[ID]>$result[WORKMODE]</option>";
                            }
                        ?>
                        </select>
                    </div>

                </div>

                <div class="row m-1 mt-4">
                    <div class="col">

                        <label for="education" class="form-label">Education</label>
                        <select id="education" name="education" class="form-control">
                        <?php
                            $v_education = getEducationById($vacancy['EDUCATION_ID']);
                            $education = getAllEducation();
                            echo "<option value=$v_education[ID]>$v_education[EDUCATION]</option>";
                            while($result = mysqli_fetch_array($education)){
                                if($result['ID'] != $vacancy['EDUCATION_ID'])
                                    echo "<option value=$result[ID]>$result[EDUCATION]</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="experience" class="form-label">Experience</label>
                        <select id="experience" name="experience" class="form-control">
                        <?php
                            $v_experience = getExperienceById($vacancy['EXPERIENCE_ID']);
                            $experience = getAllExperience();
                            echo "<option value=$v_experience[ID]>$v_experience[EXPERIENCE]</option>";
                            while($result = mysqli_fetch_array($experience)){
                                if($result['ID'] != $vacancy['EXPERIENCE_ID'])
                                    echo "<option value=$result[ID]>$result[EXPERIENCE]</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="row m-1 mt-4">

                    <div class="col">
                        <label for="age" class="form-label">Age</label>
                        <select id="age" name="age" class="form-control">
                        <?php
                            $v_age = getAgeById($vacancy['AGE_ID']);
                            $age = getAllAge();
                            echo "<option value=$v_age[ID]>$v_age[AGE]</option>";
                            while($result = mysqli_fetch_array($age)){
                                if($result['ID'] != $vacancy['AGE_ID'])
                                    echo "<option value=$result[ID]>$result[AGE]</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="col">
                        <label for="expdate" class="form-label">Exp date</label>
                        <input type="date" value="<?=$vacancy['EXP_DATE']?>" min="<?=date("Y-m-d");?>" name="expdate" class="form-control" id="expdate">
                    </div>
                </div>

                <div class="form-group m-3 mt-4">
                    <label for="editor">Information</label>
                    <div id="editor"></div>
                </div>

                <div class="form-group m-3 mt-4">
                    <label for="editor2">Requirements</label>
                    <div id="editor2"></div>
                </div>

                <div class="form-group m-3 mt-4">
                    <label for="address">Address</label>
                    <textarea id="address"  name="address" placeholder="Address" class="form-control" rows="3"><?=$vacancy['ADDRESS']?></textarea>
                </div>
                <div class="form-group m-3 justify-content-between">
                    <input type="hidden" name="information" id="information-input">
                    <input type="hidden" name="requirements" id="requirements-input">
                    <input type="hidden" name="editId" value="<?=$_GET['editId']?>">
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="edit" onclick="setEditorsData(myeditor,myeditor2,'information-input','requirements-input')" class="btn btn-primary">Save changes</button>
                        </div>
                        <div class="col text-right text-danger">
                            <span class="error-txt" id="error"><?=$error?></span>
                        </div>
                    </div>

                </div>

            </form>
        </div>


    </div>
</div>
</div>
</div>



<script>

    var myeditor;
    var myeditor2;
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            toolbar: [ 'bold','italic','|','bulletedList','|','link','undo', 'redo' ]
        } )
        .then( editor => {
            myeditor = editor;
            editor.setData('<?=$vacancy['INFORMATION']?>');
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#editor2' ),{
            toolbar: [ 'bold','italic','|','bulletedList','|','link','undo', 'redo' ]
        })
        .then( editor2 => {
            myeditor2 = editor2;
            editor2.setData('<?=$vacancy['REQUIREMENTS']?>');
            console.log( editor2 );
        } )
        .catch( error => {
            console.error( error );
        } );

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./javascript/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
