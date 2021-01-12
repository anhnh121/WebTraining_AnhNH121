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
    
    $result = get_all_result();
    
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
                    echo "<a class='active' href='../homework/up_homework.php'>Giao bài tập</a>";            
                }else{
                    echo "<a href='../homework/homework.php'>Bài tập</a>";
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
            <a href='../homework/up_homework.php'>Upload Homework</a>
            <a class="active" href="../homework/list_result.php">Danh sách bài làm</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Danh sách bài làm</a></div>
        <div class="info" style="overflow-x:auto; overflow-y: auto; padding-left: 150px;">
            <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>Title</th>
                  <th>Teacher</th>
                  <th>Student</th>
                  <th>File bài làm</th>
                  <th>TimeUpload</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($result as $item){
                        $i++; 
                        $idhw = $item['kq_homeworkid'];
                        $row_homeworks = get_homeworks($idhw);
                        $teacher_id = $row_homeworks['hw_teacherid'];
                        
                        $rs_title = $row_homeworks['hw_title'];
                        
                        $row_acc_t = get_user($teacher_id);
                        $teacher_name = $row_acc_t['acc_username'];
                        
                        $row_acc_s = get_user($item['kq_studentid']);
                        $student_name = $row_acc_s['acc_username'];
                        
                        $time = $item['kq_uptime'];
                ?>
                        <form enctype="multipart/form-data">
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rs_title;?></td>
                            <td><?php echo $teacher_name;?></td>
                            <td><?php echo $student_name;?></td>
                            <td><a download="<?php echo $student_name."_".$rs_title ?>" href="<?php echo $item['kq_path'] ?>"><?php echo $student_name."_".$rs_title ?></a></td>
                            <td><?php echo $time;?></td>
                        </tr>   
                        </form>
                  <?php } ?> 
            </table>
        </div>
       
   </body>
   
</html>
