<?php
function updateCompany(CompanyData $companyData)
{
  include 'database.php';
  $update = "UPDATE COMPANY SET NAME = '$companyData->name',
  SURNAME = '$companyData->surname',
  COMPANY_NAME = '$companyData->companyName',
  CITY_ID = '$companyData->cityId',
    PHONE = '$companyData->phone',
    WEBSITE = '$companyData->website',
    ABOUT_COMPANY='$companyData->aboutCompany' 
     WHERE ID = '$companyData->id' AND ACTIVE = 1";
  mysqli_query($con, $update);
}

function updatePhoto($path, $file, $companyId)
{
  include 'database.php';
  $getOldPhoto = "SELECT LOGO FROM COMPANY WHERE ACTIVE = 1 AND ID = $companyId";
  $result = mysqli_query($con,$getOldPhoto)->fetch_assoc();
  unlink(substr($result['LOGO'], 1));
  $filename = $file['name'];
  $currentDirectory = getcwd();
  $filecode = rand(10000, 50000);
  $newpath = $path . $filecode . $filename;
  $isUploaded = move_uploaded_file($file['tmp_name'], $currentDirectory.$newpath);
  if ($isUploaded) {
    $updatephoto = "UPDATE COMPANY SET LOGO = '$newpath' WHERE ID = '$companyId' AND ACTIVE = 1";
    mysqli_query($con, $updatephoto);
    return true;
  }

  return false;
}

function changePassword($newpassword, $email)
{
  include 'database.php';
  $query = "UPDATE COMPANY SET PASSWORD = '$newpassword' WHERE ACTIVE = 1 AND LOWER(EMAIL) = LOWER('$email')";
  $result = mysqli_query($con, $query);
}

function getCompanyById($companyId)
{
  include 'database.php';
  $query = "SELECT NAME,SURNAME,COMPANY_NAME,EMAIL,CITY_ID,WEBSITE,ABOUT_COMPANY,PHONE,LOGO FROM COMPANY WHERE ID = '$companyId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getVacanciesByCompanyId($companyId)
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY WHERE COMPANY_ID = '$companyId'";
  $result = mysqli_query($con, $query);
  return $result;
}

function getVacancyById($postId)
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY WHERE STATUS_ID = 1 AND ID = '$postId'";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getEditableVacanyById($postId)
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY WHERE ID = '$postId'";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getVacancyCountByCompanyId($companyId)
{
  include 'database.php';
  $query = "SELECT COUNT(ID) AS COUNT FROM VACANCY WHERE COMPANY_ID = '$companyId'";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result['COUNT'];
}

function getAllVacancy()
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY WHERE STATUS_ID = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getVacanciesByStatusId($status_id)
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY WHERE STATUS_ID = '$status_id'";
  $result = mysqli_query($con, $query);
  return $result;
}

function setActiveVacancy($id){
  include 'database.php';
  $query = "UPDATE VACANCY SET STATUS_ID = 1 WHERE ID = '$id'";
  mysqli_query($con, $query);
}

function changeVacancyStatus($postId,$status_id){
  include 'database.php';
  $query = "UPDATE VACANCY SET STATUS_ID = '$status_id' WHERE ID = '$postId'";
  mysqli_query($con, $query);
}

function searchVacancy($keyword,$category)
{
  include 'database.php';
  $query = "SELECT * FROM VACANCY 
  WHERE CATEGORY_ID = $category OR LOWER(VACANCY_NAME) LIKE LOWER('%$keyword%')
  AND STATUS_ID = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getAllVacancyCount()
{
  include 'database.php';
  $query = "SELECT COUNT(ID) AS COUNT FROM VACANCY WHERE STATUS_ID = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result['COUNT'];
}

function getCityById($cityId)
{
  include 'database.php';
  $query = "SELECT * FROM CITY WHERE ID = '$cityId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllCity()
{
  include 'database.php';
  $query = "SELECT * FROM CITY WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getExperienceById($experienceId)
{
  include 'database.php';
  $query = "SELECT * FROM EXPERIENCE WHERE ID = '$experienceId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllExperience()
{
  include 'database.php';
  $query = "SELECT * FROM EXPERIENCE WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getEducationById($educationId)
{
  include 'database.php';
  $query = "SELECT * FROM EDUCATION WHERE ID = '$educationId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllEducation()
{
  include 'database.php';
  $query = "SELECT * FROM EDUCATION WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getAgeById($ageId)
{
  include 'database.php';
  $query = "SELECT * FROM AGE WHERE ID = '$ageId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllAge()
{
  include 'database.php';
  $query = "SELECT * FROM AGE WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getWorkmodeById($workmodeId)
{
  include 'database.php';
  $query = "SELECT * FROM WORKMODE WHERE ID = '$workmodeId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllWorkmode()
{
  include 'database.php';
  $query = "SELECT * FROM WORKMODE WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function getCategoryById($categoryId)
{
  include 'database.php';
  $query = "SELECT * FROM CATEGORY WHERE ID = '$categoryId' AND ACTIVE = 1";
  $result = mysqli_query($con, $query)->fetch_assoc();
  return $result;
}

function getAllCategory()
{
  include 'database.php';
  $query = "SELECT * FROM CATEGORY WHERE ACTIVE = 1";
  $result = mysqli_query($con, $query);
  return $result;
}

function deleteVacancyById($id){
  include 'database.php';
  $query = "DELETE FROM VACANCY WHERE ID = '$id'";
  $result = mysqli_query($con, $query);
  return $result;
}

function rejectVacancyById($id){
  include 'database.php';
  $query = "UPDATE VACANCY SET STATUS_ID = 4 WHERE ID = '$id'";
  $result = mysqli_query($con, $query);
  return $result;
}

function updateVacancyById($id,VacancyData $vacancyData) {
  include 'database.php';
  $query = "UPDATE VACANCY 
        SET VACANCY_NAME = '$vacancyData->name', 
        SALARY = '$vacancyData->salary', 
        CATEGORY_ID = '$vacancyData->categoryId',
        WORKMODE_ID = '$vacancyData->workModeId',
        EDUCATION_ID = '$vacancyData->educationId',
        EXPERIENCE_ID = '$vacancyData->experienceId',
        AGE_ID = '$vacancyData->ageId',
        EXP_DATE = '$vacancyData->expirationDate',
        INFORMATION = '$vacancyData->information',
        REQUIREMENTS = '$vacancyData->requirements',
        ADDRESS = '$vacancyData->address',
        STATUS_ID = '$vacancyData->activeStatus'
        WHERE ID = '$id'";
  
  mysqli_query($con, $query);
  return true;

}

function insertCompany(CompanyData $companyData){
  include 'database.php';
  $query = "INSERT INTO COMPANY (COMPANY_NAME,NAME,SURNAME,EMAIL,PHONE,PASSWORD,CITY_ID,ABOUT_COMPANY,DATA_DATE,ACTIVE,WEBSITE,LOGO) 
  VALUES ('$companyData->companyName', 
  '$companyData->name', 
  '$companyData->surname', 
  '$companyData->email', 
  '$companyData->phone',
   '$companyData->password',
   '$companyData->cityId',
   '$companyData->aboutCompany',
   '$companyData->dataDate',
   '$companyData->active',
   '$companyData->website',
   '$companyData->logo')";
   mysqli_query($con,$query);
}

function createVacancy(VacancyData $vacancyData) {
  include 'database.php';
  $insert = "INSERT INTO VACANCY (VACANCY_NAME, INFORMATION, REQUIREMENTS, SALARY, ADDRESS, AGE_ID, CATEGORY_ID, COMPANY_ID, EXPERIENCE_ID, EDUCATION_ID, WORKMODE_ID, STATUS_ID, DATA_DATE, EXP_DATE)
         VALUES ('$vacancyData->name','$vacancyData->information','$vacancyData->requirements','$vacancyData->salary','$vacancyData->address','$vacancyData->ageId','$vacancyData->categoryId','$vacancyData->companyId','$vacancyData->experienceId','$vacancyData->educationId','$vacancyData->workModeId','$vacancyData->activeStatus','$vacancyData->dateCreated','$vacancyData->expirationDate')";
  mysqli_query($con, $insert);
}

function getModeratorByEmail($email) {
  include 'database.php';
  $getModeratorDataQuery = "SELECT * FROM Moderator WHERE lower(Email) = lower('$email')";
  return mysqli_query($con, $getModeratorDataQuery)->fetch_assoc();
}
