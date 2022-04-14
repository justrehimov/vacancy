<?php
include 'database.php';
include 'databasemanager.php';
include 'cookiemanager.php';
session_start();
$vacancies = getVacanciesByStatusId(3);
if(!isset($_SESSION['moderator'])){
  header("Location:moderatorAuth.php");
}
if(isset($_POST['postId']) & !empty($_POST['postId'])){
  if(is_numeric($_POST['postId'])){
    $action = $_GET['action'];
    switch($action){
      case "publish":
        setActiveVacancy($_POST['postId']);
        header("Location:moderator.php");
        break;
      case "reject":
        rejectVacancyById($_POST['postId']);
        header("Location:moderator.php");
        break;
      case "delete":
        deleteVacancyById($_POST['postId']);
        header("Location:moderator.php");
        break;  
      default:
        header("Location: error.php?error=true");
  }    
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
    <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
<div class="container-95 rounded bg-white m-4">
  <div class="text-right"> <a href="moderatorlogout.php" class="btn btn-primary m-2">Logout</a></div>
  <div class="h2 text-center" style="width: 100%;padding:2rem 0rem;">Unconfirmed vacancies</div>
<div class="row m-2 p-1">
  <?php
    while($v = mysqli_fetch_array($vacancies)){
    $company = getCompanyById($v['COMPANY_ID']);
    ?>
  <div class="col-sm-6 mt-3 mb-3 p-3 bg-primary">
        <div class="card">
      <div class="card-body">
        <h5 class="card-title" style="color:black"><?=$v['VACANCY_NAME']?></h5>
        <p class="card-text" style="color:blue"><?=$company['COMPANY_NAME']?></p>
        <div class="row">
        <button class="btn btn-primary m-1" onclick="setData('<?=$v['REQUIREMENTS']?>','<?=$v['INFORMATION']?>','<?=$v['ADDRESS']?>')" data-toggle="modal" data-target="#exampleModal">Details</button>
        <form action="moderator.php?action=publish" class="m-1" method="post">
          <input type="hidden" name="postId" value="<?=$v['ID']?>">
          <button name="publish" type="submit" class="btn btn-success">Publish</button>
          </form>
          <form action="moderator.php?action=reject" class="m-1" method="post">
          <input type="hidden" name="postId" value="<?=$v['ID']?>">
          <button name="reject" type="submit" class="btn btn-warning">Reject</button>
          </form>
          <form class="m-1">
            <button type="button" onclick="setId(<?=$v['ID']?>)" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#delModal" >Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 <?php } ?>
</div>
</div>

<!-- Details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Java Backend Developer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="information">
           <h6><strong>About the vacancy</strong></h6>
           <div id="info"></div>
      </div><br>
       <div class="form-group">
           <h6><strong>Requirements for vacancy</strong></h6> 
           <div class="row" id="req"></div>       
      </div>
      <div class="address">
           <h6><strong>Address</strong></h6> 
           <div id="address">
  </div>       
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete vacancy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" style="border: none;font-size: 1.5rem;outline: none; background: transparent;" aria-label="Close">&#10005;</button>
      </div>
      <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="post" action="moderator.php?action=delete">
          <input type="hidden" id="del-id" name="postId">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  let infoeditor;
  let reqeditor;
     ClassicEditor
        .create(document.querySelector('#info'),{
            toolbar: []
        })
        .then(editor => {
            editor.isReadOnly=true;
            infoeditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#req'),{
            toolbar: []
        })
        .then(editor2 => {
          editor2.isReadOnly=true;
          reqeditor = editor2;
        })
        .catch(error => {
            console.error(error);
        });
  function setData(info,req,address){
     infoeditor.setData(info);
     reqeditor.setData(req);
     document.getElementById("address").innerHTML = address;   
  }
    function setId(id) {
    var delinput = document.getElementById('del-id');
    delinput.value = id;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="./javascript/main.js"></script>
</body>
</html>
