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
    
    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {
        $oldpass = filter_input(INPUT_POST, 'oldpass');
        $newpass = filter_input(INPUT_POST, 'newpass');
        $repass = filter_input(INPUT_POST, 'repass');
        $update_pass = addslashes($newpass);
        if(($oldpass !== $login_pass) or ($oldpass === $newpass)){
            $error = "Your Password is invalid";
            phpAlert($error);
        } elseif ($newpass !== $repass) {
            $error = "You entered two different passwords";
            phpAlert($error);
        } else{
            $update_sql = mysqli_query($db,"UPDATE ACCOUNTS SET acc_password='$update_pass' WHERE acc_id='$login_id' ");
            $error = "Change Password OK";
            phpAlert($error);
        }
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
            <a class="active" href="../login/welcome.php">Profile</a>
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
            <a href="../login/welcome.php">Thông tin cá nhân</a>
            <a class="active" href="../user_info/changepass.php">Đổi mật khẩu</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Đổi mật khẩu</a></div>
        <div class="info">
            <form action="../user_info/changepass.php" method = "post">
                <label for="old">Current Password</label><br>
                <input type="password" id="oldpass" name="oldpass"><br>

                <label for="new">New Password</label><br>
                <input type="password" id="newpass" name="newpass"><br>
                
                <label for="re">Re-Enter Password</label><br>
                <input type="password" id="repass" name="repass"><br>
                
                <input type="submit" value="Submit"><br>
            </form>
        </div>
       
   </body>
   
</html>
