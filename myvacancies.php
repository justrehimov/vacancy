<?php
include 'cookiemanager.php';
include 'database.php';
include 'databasemanager.php';
isLogin('user');
$showBtnDisplay = "";
$vacancyStatus = "";
$companyId = $_COOKIE['user'];
$company = getCompanyById($companyId);
$myvacancies = getVacanciesByCompanyId($companyId);

if(isset($_POST['deleteId']) & !empty($_POST['deleteId'])) {
  deleteVacancyById($_POST['deleteId']);
  header("Location: myvacancies.php");
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
  <link rel="stylesheet" media="screen and (min-width: 768px)" href="./desktop-css/myvacancies.css">
  <link rel="stylesheet" media="screen and (max-width: 767px)" href="./desktop-css/myvacancies.css">
  <title>My vacancies</title>
</head>
<body>
<div class="container rounded bg-white mt-4 mb-4">
  <div class="row">
    <div class="col-md-3 border-right">
      <div class="d-flex flex-column align-items-center text-center p-3 py-5">
        <img class="rounded-circle mt-5" width="150px" src=".<?=$company['LOGO']?>">
        <span class="font-weight-bold"><?=$company['NAME']." ".$company['SURNAME']?></span>
        <span class="text-black-50"><?=$company['EMAIL']?></span>
        <span class="mt-5"><a href="index.php">Back to home</a></span>
      </div>
    </div>
    <div class="col-md-9 border-right" id="container">
      <div class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="text-right">Edit vacancies</h4>
        </div>
        <div class="form-row" id="content">

        <?php
          while($vacancy = mysqli_fetch_array($myvacancies)) {
            $workmode = getWorkmodeById($vacancy['WORKMODE_ID']);
            $experience = getExperienceById($vacancy['EXPERIENCE_ID']);
            $education = getEducationById($vacancy['EDUCATION_ID']);
            $v_company = getCompanyById($vacancy['COMPANY_ID']);
            $city = getCityById($v_company['CITY_ID']);
            $statusId = $vacancy['STATUS_ID'];

            $showBtnDisplay = getButtonDisplayModeByStatusId($statusId);
            $vacancyStatus = getStatusByStatusId($statusId);

          ?>

          <div class="card text-center mt-3 mb-3 border-info">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                  <a class="btn btn-info mr-2" style="<?=$showBtnDisplay?>" href="post.php?postId=<?=$vacancy['ID']?>">Show</a>
                </li>
                <li class="nav-item">
                  <form method="get" action="edit.php">
                    <button type="submit" value="<?=$vacancy['ID']?>" name="editId" class="btn btn-secondary mr-2">Edit</button>
                  </form>
                </li>
                <li class="nav-item">
                  <button class="btn btn-danger mr-2"  onclick="setId(<?=$vacancy['ID']?>)" data-bs-toggle="modal" data-bs-target="#exampleModal" >Delete</button>
                </li>
                <li class="nav-item">
                  <span class="nav-item text-center btn" style="font-size: 1rem;" >Status: <?=$vacancyStatus ?></span>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title"style="color: #8a3ab9;"><?=$vacancy['VACANCY_NAME']?></h5>
              <div class="form-row justify-content-between mt-4" style="display: flex;">
                <div class="form-group">
                  <p class="card-text text-left" >Post Date:<span style="color: #0EBBDA;"><?=$vacancy['DATA_DATE']?></span></p>
                  <p class="card-text text-left" >Exp Date:<span style="color: #0EBBDA;"><?=$vacancy['EXP_DATE']?></span></p>
                </div>
                <div class="form-group">
                  <p class="card-text text-left" >Education:<span style="color: #0EBBDA;"><?=$education['EDUCATION']?></span></p>
                  <p class="card-text text-left" >Experience:<span style="color: #0EBBDA;"><?=$experience['EXPERIENCE']?></span></p>
                </div>
                <div class="form-group">
                  <p class="card-text text-left" >Workmode:<span style="color: #0EBBDA;"><?=$workmode['WORKMODE']?></span></p>
                  <p class="card-text text-left" >City:<span style="color: #0EBBDA;"><?=$city['CITY']?></span></p>
                </div>
              </div>
            </div>
          </div>

          <?php
          }
          function getButtonDisplayModeByStatusId($status_id) {
            $status = "";

            if ($status_id == 1) {
              $status = "display:flex !important;";
            }
            else {
              $status = "display:none !important;";
            }

            return $status;
          }

          function getStatusByStatusId($status_id) {

            $status = "";

            if ($status_id == 1) {
              $status = "Confirmed";
            }
            else if ($status_id == 2) {
              $status = "Deactive";
            }
            else if ($status_id == 3) {
              $status = "Checking";
            }
            else if ($status_id == 4) {
              $status = "Rejected";
            }

            return $status;
          }
          ?>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form method="post" action="myvacancies.php">
          <input type="hidden" id="del-id" name="deleteId">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function setId(id) {
    var delinput = document.getElementById('del-id');
    delinput.value = id;
  }

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
