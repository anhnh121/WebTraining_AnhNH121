<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../connectDB.php';
   session_start();
   if(session_destroy()) {
      disconnect_db();
      header("Location: login.php");
   }
?>