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
    
    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $fullname = filter_input(INPUT_POST, 'fullname');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        add_student($username, $password, $fullname, $email, $phone);
        echo "<meta http-equiv='refresh' content='0'>";
    }    
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
            <a class="active" href="qlsv.php">Quản lý Sinh viên</a>
            <a href="#homework">Giao bài tập</a>
            <a href="#inbox">Hòm thư</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a href="qlsv.php">Cập nhật sinh viên</a>
            <a class="active" href="adduser.php">Thêm sinh viên</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Thêm sinh viên</a></div>
        <div class="info">
            <form action="adduser.php" method="post">
                <label for="uname">User Name</label><br>
                <input type="text" id="uname" name="username"><br>
                
                <label for="uname">Password</label><br>
                <input type="password" id="password" name="password"><br> 
                
                <label for="fname">Full Name</label><br>
                <input type="text" id="fname" name="fullname"><br>
                   
                <label for="email">Email</label><br>
                <input type="text" id="email" name="email""><br>
                
                <label for="phone">Phone</label><br>
                <input type="text" id="phone" name="phone"><br>

                <input type="submit" value="Submit"><br>
            </form>
        </div>
       
   </body>
   
</html>
