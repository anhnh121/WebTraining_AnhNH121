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
        $newemail = filter_input(INPUT_POST, 'email');
        $newphone = filter_input(INPUT_POST, 'phone');
        // Chống SQL Injection
        $update_email = addslashes($newemail);
        $update_phone = addslashes($newphone);
        if(($login_phone === $newphone) and ($newemail === $login_email)){
            $error = "Nothing changes";
            phpAlert($error);
        }else{
            $update_sql = mysqli_query($db,"UPDATE ACCOUNTS SET acc_email='$update_email',acc_phone='$update_phone' WHERE acc_id='$login_id' ");
            $error = "Change OK";
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
            <a href="../user_info/userlist.php">Danh sách người dùng</a>
            <?php 
                if($login_role == 0){
                    echo "<a href='../user_info/qlsv.php'>Quản lý Sinh viên</a>";
                    echo "<a href='#homework'>Giao bài tập</a>";            
                }else{
//                    echo "<a href='../user_info/qlsv.php'>Thông tin Sinh viên</a>";
                    echo "<a href='#bt'>Bài tập</a>";
                }
            ?>   
            <a href="../msg/inbox.php">Hòm thư</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a class="active" href="../login/welcome.php">Thông tin cá nhân</a>
            <a href="../user_info/changepass.php">Đổi mật khẩu</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Cập nhật thông tin</a></div>
        <div class="info">
            <form action="welcome.php" method="post">
                <label for="uname">User Name</label><br>
                <input type="text" id="uname" name="username" value=<?php echo $login_name;?> disabled><br>

                <label for="fname">Full Name</label><br>
                <input type="text" id="fname" name="fullname" value=<?php echo "'$login_fullname'";?> disabled><br>
                   
                <label for="email">Email</label><br>
                <input type="text" id="email" name="email" value="<?php echo $login_email;?>"><br>
                
                <label for="phone">Phone</label><br>
                <input type="text" id="phone" name="phone" value=<?php echo $login_phone;?>><br>
                
                <label for="role">Role</label><br>
                <input type="text" id="role" name="role" value=<?php echo $role;?> disabled><br>
                
                <input type="submit" value="Submit"><br>
            </form>
        </div>
       
   </body>
   
</html>
