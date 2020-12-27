<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //include('session.php');
    require '../connectDB.php';
    session_start(); 
    
    $db = connect_db();
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db,"select * from accounts where acc_username = '$user_check' ");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_name = $row['acc_username'];
    $login_role = $row['acc_role'];
    if($login_role == 0){
        $role = "Teacher";
    } else{
        $role = "Student";
    }

    if(!isset($_SESSION['login_user'])){
       header("location:login.php");
       die();
    }
?>
<html>
   <head>
      <title>Welcome </title>
      <link rel="stylesheet" type="text/css" href="../topnav.css" />
      <link rel="stylesheet" type="text/css" href="../tab.css" />
   </head>
   
   <body>
        <div class="topnav">
            <a class="active" href="#home">Home</a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "logout.php">Sign Out</a>
            </div>
        </div>
<!--        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">London</button>
            <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
            <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
        </div>
        <script>
            function openCity(evt, cityName) {
              var i, tabcontent, tablinks;
              tabcontent = document.getElementsByClassName("tabcontent");
              for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
              }
              tablinks = document.getElementsByClassName("tablinks");
              for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
              }
              document.getElementById(cityName).style.display = "block";
              evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>-->
        <div class="tab">
            <a class="active" href="#london">London</a>
            <a href="#paris">Paris</a>
            <a href="#hanoi">HaNoi</a>
        </div>
   </body>
   
</html>
