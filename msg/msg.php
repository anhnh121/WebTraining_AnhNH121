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
    
    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "GET") {
        $detail_id = filter_input(INPUT_GET, 'acc_row');
        $row = get_user($detail_id);
        
        $user_name = $row['acc_username'];
        $user_fullname = $row['acc_fullname'];
        $user_email = $row['acc_email'];
        $user_phone = $row['acc_phone'];
        $user_pass = $row['acc_password'];
        $user_role = $row['acc_role'];
        if($user_role == 0){
            $urole = "Teacher";
        } else{
            $urole = "Student";
        }
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
            <a class='active' href="../user_info/userlist.php">Danh sách người dùng</a>
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
        </div>
        <div>
            <a style="text-decoration: none; color:#AC4CAF; font-size: 30px;" href="../user_info/userlist.php" class="previous" >Danh sách người dùng</a>
            <a style="color:#45a049;font-size: 30px;">&raquo;Thông tin chi tiết</a>
        </div>
       <div class="info" style="padding-top: 50px; padding-right: 30px; padding-bottom: 50px; padding-left: 320px;">
            <form action="msg.php" method="post">
                <label for="uname">User Name</label><br>
                <input type="text" id="uname" name="username" value=<?php echo $user_name;?> disabled><br>

                <label for="fname">Full Name</label><br>
                <input type="text" id="fname" name="fullname" value=<?php echo "'$user_fullname'";?> disabled><br>
                   
                <label for="email">Email</label><br>
                <input disabled type="text" id="email" name="email" value="<?php echo $user_email;?>"><br>
                
                <label for="phone">Phone</label><br>
                <input disabled type="text" id="phone" name="phone" value=<?php echo $user_phone;?>><br>
                
                <label for="role">Role</label><br>
                <input disabled type="text" id="role" name="role" value=<?php echo $urole;?> ><br>
                <label for="subject">Message</label><br>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px; width: 60% "></textarea><br>
                <input type="submit" value="Send"><br>
            </form>
        </div>
       
   </body>
   
</html>
