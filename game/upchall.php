<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //include('session.php');
    require '../connectDB.php';
    require '../Util.php';
    require '../homework/download.php';
    session_start(); 
    
    $db = connect_db();
    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db,"select * from ACCOUNTS where acc_username = '$user_check' ");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_id = $row['acc_id'];
    $login_name = $row['acc_username'];
    $login_role = $row['acc_role'];
    $login_fullname = $row['acc_fullname'];
    $login_email = $row['acc_email'];
    $login_phone = $row['acc_phone'];
    $login_pass = $row['acc_password'];
    if($login_role == 0){
        $role = "Teacher";
    } else{
        $role = "Student";
    }

    if(!isset($_SESSION['login_user'])){
       header("location:login.php");
       die();
    }
    
    
//    echo "<meta http-equiv='refresh' content='0'>";
?>
<html>
   <head>
      <title>Welcome </title>
      <link rel="stylesheet" type="text/css" href="../topnav.css" />
      <link rel="stylesheet" type="text/css" href="../sidenav.css" />
      <link rel="stylesheet" type="text/css" href="../user_info/update_info.css" />
   </head>
   
   <body>
        <div class="topnav">
            <a href="../login/welcome.php">Profile</a>
            <a href="../user_info/userlist.php">Danh sách người dùng</a>
            <?php 
                if($login_role == 0){
                    echo "<a href='../user_info/qlsv.php'>Quản lý Sinh viên</a>";
                    echo "<a href='../homework/up_homework.php'>Giao bài tập</a>";            
                }else{
                    echo "<a href='../homework/homework.php'>Bài tập</a>";
                }
            ?>   
            <a href="../msg/inbox.php">Hòm thư</a>
            <a class="active" href="../game/game.php">Game</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a href="../game/game.php">Challenge</a>
            <?php 
                if($login_role == 0){
                    echo "<a class='active' href='../game/upchall.php'>Upload Challenge</a>";            
                }
            ?>            
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Challenge</a></div>
        <div class="info" style="overflow-x:auto; overflow-y: auto; padding-left: 150px;">
            <form method="POST" enctype="multipart/form-data" action="../game/upload_challenge.php">
                <label for="uname">Challenge</label><br>
                <input type="text" id="hint" name="hint" placeholder="Press Hint..."><br>
                <input type="file" name="challenge"><br>
                <button style="background-color: #4CAF50; width: 60%; padding: 14px 20px; margin: 8px 0;color: white; 
                        border: none; border-radius: 4px; cursor: pointer;"
                        type="submit" name="uploadclg" value="<?php echo $login_id;?>">Upload</button><br>
            </form>
        </div>
       
   </body>
   
</html>