<?php
function isLogin($cookiename){
    
    if(empty($_COOKIE[$cookiename])){
        header("Location: login.php");
    }
}
 function deleteCookie($cookiename){
    setcookie($cookiename, "", time() - (86400 * 5));
 }

 function setCookieData($cookiename,$userId){
    setcookie($cookiename, $userId, time() + (86400 * 5));
 }

?>