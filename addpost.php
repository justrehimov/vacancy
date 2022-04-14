<?php
include 'database.php';
include 'cookiemanager.php';
include 'vacancydata.php';
include 'databasemanager.php';
isLogin('user');

if(!isset($_POST['vacancy']) || !isset($_POST['salary']) || !isset($_POST['category']) || !isset($_POST['workmode']) || !isset($_POST['experience']) || !isset($_POST['education'])
|| !isset($_POST['expdate']) || !isset($_POST['age']) || !isset($_POST['information']) || !isset($_POST['requirements']) || !isset($_POST['address']) || !isset($_POST['addpost'])) {
    header("Location: new-post.php?error=1");
    return;
}

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
    $dateCreated = date("Y.m.d");
    $companyId = $_COOKIE['user'];

    if(empty($vacancyName) || empty($salary) || empty($categoryId) || empty($workmodeId) || empty($experienceId) || empty($educationId)
    || empty($expirationDate) || empty($information) || empty($requirements) || empty($address) || empty($ageId)) {
        header("Location: new-post.php?error=2");
        return;
    }
    $vacancyData = new VacancyData(NULL, 3, $companyId, $dateCreated, $vacancyName, $salary, $categoryId, $workmodeId, $experienceId, $educationId, $ageId, $expirationDate, $information, $requirements, $address);
    createVacancy($vacancyData);
    header("Location: vacancylist.php");

?>