<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Getting user upload file homework
require '../Util.php';
require '../connectDB.php';

$file = $_FILES["file_homework"];

// Saving file in uploads folder
$filename = filter_input(INPUT_POST, 'homework');
$size = $file["size"];
$ext = pathinfo($file["name"], PATHINFO_EXTENSION);
if(!in_array($ext, ['zip', 'pdf', 'doc', 'docx', 'txt'])){
    $msg = "Your file extension must be .zip, .pdf, .doc, .docx, .txt";
}elseif ($size > 1000000) { // file shouldn't be large than 1 MB
    $msg = "File too large !!!";
}else{
    
    $dest_homework = "../uploads/homework/".$filename.".".$ext;
    if(move_uploaded_file($file["tmp_name"], $dest_homework)){
        $msg = "Upload OK !!!";
    }
    else{
        $msg = "Upload Failed !!!";
    }
}
    //Redirecting back to home 
    phpAlert2($msg, "up_homework.php");
    
?>