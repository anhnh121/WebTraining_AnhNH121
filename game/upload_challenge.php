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

if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {
    if(isset($_FILES["challenge"]) AND !empty($_POST["uploadclg"])){
    $file = $_FILES["challenge"];

    $hint = filter_input(INPUT_POST, 'hint');
    if($hint == null){
        $msg = "Press Hint !!!";
    }else{
            // Saving file in uploads folder
        $filename = $file["name"];
        $size = $file["size"];
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        if($ext !== "txt"){
            $msg = "Your file extension must be .txt";
        }elseif ($size > 1000000) { // file shouldn't be large than 1 MB
            $msg = "File too large !!!";
        }else{
            $filename = strtolower($filename);
            $nowid = add_challenge($hint);
            $new_ext="id".$nowid;
            $new_name = replace_extension($filename, $new_ext);
            $dest_homework = "../game/save/".$new_name;
            if(move_uploaded_file($file["tmp_name"], $dest_homework)){
                $msg = "Upload_OK"; 
            }
            else{
                $msg = "Upload Failed !!!";
            }
        }
    }

        //Redirecting back to home 
        phpAlert2($msg, "upchall.php");
    
    }
}   

    
?>