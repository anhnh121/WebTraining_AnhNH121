<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

function phpAlert2($msg, $location) {
    echo '<script type="text/javascript">alert("' . $msg . '"); location = "' . $location . '";</script>';
}

function scriptLocation($location){
    echo '<script type="text/javascript">location = "' . $location . '";</script>';
}

function replace_extension($filename, $new_extension) {
    $info = pathinfo($filename);
    return $info['filename'] . '.' . $new_extension;
}

?>