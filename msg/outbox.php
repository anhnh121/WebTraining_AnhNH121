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
    
    $msg_aray = get_all_msg($login_id, "outbox");
    
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
        if(isset($_POST['deleteItem']) AND is_numeric($_POST['deleteItem'])){
            $delete_id = filter_input(INPUT_POST, 'deleteItem');
            delete_msg($delete_id);       
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
                    echo "<a href='../homework/homework.php'>Bài tập</a>";
                }
            ?>   
            <a class="active" href="../msg/inbox.php">Hòm thư</a>
            <a href="../game/game.php">Game</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a href="../msg/inbox.php">Inbox</a>
            <a class="active" href="../msg/outbox.php">Sent</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Sent</a></div>
        <div class="info" style="overflow-x:auto; overflow-y: auto; padding-left: 150px;">
            <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>Sent To</th>
                  <th>Msg</th>
                  <th>Time</th>
                  <th>Actions</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($msg_aray as $item){$i++; 
                        $recverid =  $item['msg_idrecver'];
                        $user_recver = get_user($recverid);
                        $recver = $user_recver['acc_username'];
                ?>
                        <form action="outbox.php" method ="post">
                        <tr style="overflow: scroll;">
                            <td><?php echo $i; ?></td>
                            <td><input disabled style="width: 90%;" type="text" id="username" name="username" value="<?php echo $recver;?>" ></td>
                            <td><input disabled style="width: 90%;" type="text" id="password" name="password" value="<?php echo $item['msg_msg'];?>"></td>
                            <td><input disabled style="width: 90%;" type="text" id="fullname" name="fullname" value="<?php echo $item['msg_time'];?>"></td>
                            <td>
                                <button type="submit" name="deleteItem" value="<?php echo $item['msg_id'];?>">Delete</button>
                            </td>
                        </tr>   
                        </form>
                <?php } ?>
            </table>
        </div>
       
   </body>
   
</html>
