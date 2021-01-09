<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //include('session.php');
    require '../connectDB.php';
    require '../Util.php';
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
    
    $homeworks = get_all_homeworks();
    
?>
<html>
   <head>
      <title>Welcome </title>
      <link rel="stylesheet" type="text/css" href="../topnav.css" />
      <link rel="stylesheet" type="text/css" href="../sidenav.css" />
      <link rel="stylesheet" type="text/css" href="../user_info/update_info.css" />
      <style>
            table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid black;
                overflow: scroll;
              
            }

            th, td {
                text-align: center;
                padding-top: 8px;
                padding-right: 2px;
                padding-bottom: 2px;
                padding-left: 2px;
                border: 1px solid black;
                white-space: nowrap;
            }

            tr:nth-child(even){
/*                background-color: #pink;*/
                
            }
        </style>
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
                    echo "<a class='active' href='../homework/homework.php'>Bài tập</a>";
                }
            ?>   
            <a href="../msg/inbox.php">Hòm thư</a>
            <a href="../game/game.php">Game</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
<!--            <a href="../msg/inbox.php">Inbox</a>
            <a class="active" href="../msg/outbox.php">Outbox</a>-->
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Danh sách bài tập</a></div>
        <div class="info" style="overflow-x:auto; overflow-y: auto; padding-left: 150px;">
            <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>Title</th>
                  <th>Teacher</th>
                  <th>TimeUpload</th>
                  <th>File BT</th>
                  <th>Bài làm</th>
                  <th>Actions</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($homeworks as $item){
                        $i++; 
                        $idteacher = $item['hw_teacherid'];
                        $user_upload = get_user($idteacher);
                        $teacher_name = $user_upload['acc_username'];
                        $onlyname = basename($item['hw_path']);
                ?>
                        <form method="POST" enctype="multipart/form-data" action="../homework/upload.php">
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item['hw_title'];?></td>
                            <td><?php echo $teacher_name;?></td>
                            <td><?php echo $item['hw_uptime'];?></td>
                            <td><a download="<?php echo $onlyname ?>" href="../uploads/homework/<?php echo $onlyname ?>"><?php echo $onlyname ?></a></td>
                            <td><input type="file" name="file_result"></td>
                            <td><button type="submit" name="up_result" value="<?php echo $item['hw_id'];?>">Nộp bài</button></td>
                        </tr>   
                        </form>
                  <?php } ?> 
            </table>
        </div>
       
   </body>
   
</html>
