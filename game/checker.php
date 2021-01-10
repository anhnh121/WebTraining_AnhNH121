<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function check_result_challenge($clg_id, $clg_result){
    $files = scandir("../game/save");
    $icheck = "id".$clg_id;
    $challenge_result = strtolower($clg_result);
    for ($i = 2; $i < count($files); $i++){
       $parse = pathinfo($files[$i]);
       if(($parse['extension'] === $icheck) AND $challenge_result === $parse['filename']){
            return TRUE;
       }
    }
    return FALSE;
}
        
function get_data_file($filename){
    $myfile = fopen($filename, "r") or die("Unable to open file!");
    $data = fread($myfile,filesize($filename));
    fclose($myfile);
    return $data;
}
?>