<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Getting user upload file homework
require '../Util.php';
require '../connectDB.php';
session_start(); 
$user_check = $_SESSION['login_user'];
$db = connect_db();
$ses_sql = mysqli_query($db,"select * from ACCOUNTS where acc_username = '$user_check' ");
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_id = $row['acc_id'];

if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {
    if(isset($_FILES["file_homework"]) AND !empty($_POST["uploadhw"])){
    $file = $_FILES["file_homework"];

    $uploader_id = filter_input(INPUT_POST, 'uploadhw');
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
            $msg = add_homework($filename, $dest_homework, $uploader_id); 
        }
        else{
            $msg = "Upload Failed !!!";
        }
    }
        //Redirecting back to home 
        phpAlert2($msg, "up_homework.php");
    }elseif (isset($_FILES["file_result"]) AND !empty($_POST["up_result"])) {
        $file = $_FILES["file_result"];
        $uploader_id = $login_id;
        $homeworkid = filter_input(INPUT_POST, 'up_result');
        $filename = $login_id . "_" . $homeworkid;
        $size = $file["size"];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        if(!in_array($ext, ['zip', 'pdf', 'doc', 'docx', 'txt'])){
            $msg = "Your file extension must be .zip, .pdf, .doc, .docx, .txt";
        }elseif ($size > 1000000) { // file shouldn't be large than 1 MB
            $msg = "File too large !!!";
        }else{
            $dest_result = "../uploads/result/".$filename.".".$ext;
            if(move_uploaded_file($file["tmp_name"], $dest_result)){
                $msg = add_result($uploader_id,$homeworkid, $dest_result); 
            }else{
                $msg = "Upload Failed !!!";
            }
        }
        //Redirecting back to home 
        phpAlert2($msg, "homework.php");
    }else {

    }
}

    
?>