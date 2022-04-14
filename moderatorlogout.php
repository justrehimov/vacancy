<?php
session_start();
if(!empty($_SESSION['moderator'])){
    session_destroy();    
}
header("Location:moderatorAuth.php");
?>