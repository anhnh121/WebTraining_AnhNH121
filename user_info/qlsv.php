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
    $login_name = $_SESSION['login_user'];
    $ses_sql = mysqli_query($db,"select * from ACCOUNTS where acc_username = '$login_name' ");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_role = $row['acc_role'];
    if($login_role == 0){
        $role = "Teacher";
    } else{
        $role = "Student";
    }
//    $ses_sql = mysqli_query($db,"select * from ACCOUNTS where acc_role=1 ");
//    while($row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC)){
//        echo "id: " . $row['acc_id']. " - Name: " . $row['acc_username']. "- FullName:  " . $row["acc_fullname"]. "<br>";
//    }
//    $login_id = $row['acc_id'];
//    $login_name = $row['acc_username'];
//    $login_role = $row['acc_role'];
//    $login_fullname = $row['acc_fullname'];
//    $login_email = $row['acc_email'];
//    $login_phone = $row['acc_phone'];
//    $login_pass = $row['acc_password'];


    if(!isset($_SESSION['login_user'])){
       header("location:login.php");
       die();
    }
    
//    echo "<table border='1'>
//    <tr>
//    <th>Firstname</th>
//    <th>Lastname</th>
//    </tr>";
//
//    while($row)
//    {
//        echo "<tr>";
//        echo "<td>" . $row['acc_username'] . "</td>";
//        echo "<td>" . $row['acc_fullname'] . "</td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//
//    mysqli_close($con);
    
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
              
            }

            th, td {
              text-align: center;
              padding: 8px;
              border: 1px solid black;
            }

            tr:nth-child(even){
/*                background-color: #f2f2f2;*/
            }
        </style>
   </head>
   
   <body>
        <div class="topnav">
            <a href="../login/welcome.php">Profile</a>
            <?php 
                if($login_role == 0){
                    echo "<a href='../user_info/qlsv.php'>Quản lý Sinh viên</a>";
                    echo "<a href='#homework'>Giao bài tập</a>";            
                }else{
//                    echo "<a href='../user_info/qlsv.php'>Thông tin Sinh viên</a>";
                    echo "<a href='#bt'>Bài tập</a>";
                }
            ?>   
            <a href="#inbox">Hòm thư</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a class="active" href="qlsv.php">Cập nhật sinh viên</a>
            <a href="adduser.php">Thêm sinh viên</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Cập nhật sinh viên</a></div>
        <div class="info" style="overflow-x:auto; padding-left: 150px;">
              <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>User Name</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                </tr>
                  <?php
                    $sql_query = mysqli_query($db,"select * from ACCOUNTS where acc_role=1 ");
                    $i = 1;
                    while($row = mysqli_fetch_array($sql_query,MYSQLI_ASSOC)){                        
                        echo "<tr>";
                        echo "<td>" . $i . "</td>";
                        echo "<td>" . $row['acc_username'] . "</td>";
                        echo "<td>" . $row['acc_fullname'] . "</td>";
                        echo "<td>" . $row['acc_email'] . "</td>";
                        echo "<td>" . $row['acc_phone'] . "</td>";
                        echo "</tr>";
                        $i++;
//                        echo "id: " . $row['acc_id']. " - Name: " . $row['acc_username']. "- FullName:  " . $row["acc_fullname"]. "<br>";
                    }
                  ?>            
              </table>
        </div>
       
   </body>
   
</html>
