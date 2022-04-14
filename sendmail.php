<?php 
 
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
  
 
function sendCode($mailto,$code){
    $mail = new PHPMailer;
    $mail -> isSMTP();
    $mail -> SMTPAuth = true;
    $mail -> SMTPSecure = 'ssl';
    $mail -> Host = 'smtp.gmail.com';
    $mail -> Port = 465;
    $mail -> Username = 'ekadrcompany@gmail.com';
    $mail -> Password = 'ulaaqvljhtiuucau';
    $mail -> SetFrom('Ekadr');
    $mail -> Subject = 'Use code for confirm';
    $mail -> Body = 'Your confirm code: '.$code;
    $mail -> AddAddress($mailto);
    $mail ->Send();
}
 
?>