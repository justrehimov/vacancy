<?php

function uploadFile($path,$file){
     $filename = $file['name'];
     $currentDirectory = getcwd();
     $filecode = rand(10000,50000);
     $newpath = $path.$filecode.$filename;
     $isuploaded = move_uploaded_file($file['tmp_name'], $currentDirectory.$newpath);
     if($isuploaded){
         return $newpath;
     }else{
         return "error";
     }
}
?>