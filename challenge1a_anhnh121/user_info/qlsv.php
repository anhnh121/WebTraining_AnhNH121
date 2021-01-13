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
    $login_id = $row['acc_id'];
    $students = get_all_students();
                    
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
            delete_student($delete_id);
            
        }
        if(isset($_POST['updateItem']) AND is_numeric(filter_input(INPUT_POST, 'updateItem'))){
            $update_id = filter_input(INPUT_POST, 'updateItem');
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $fullname = filter_input(INPUT_POST, 'fullname');
            $email = filter_input(INPUT_POST, 'email');
            $phone = filter_input(INPUT_POST, 'phone');
            edit_student($update_id, $username, $password, $fullname, $email, $phone);
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }   
    disconnect_db();
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
                padding-top: 8px;
                padding-right: 2px;
                padding-bottom: 2px;
                padding-left: 2px;
                border: 1px solid black;
                white-space: nowrap;
            }

            tr:nth-child(even){
/*                background-color: #f2f2f2;*/
            }
        </style>
   </head>
   
   <body>
        <div class="topnav">
            <a href="../login/welcome.php">Profile</a>
            <a href="../user_info/userlist.php">Danh sách người dùng</a>
            <?php 
                if($login_role == 0){
                    echo "<a class='active' href='../user_info/qlsv.php'>Quản lý Sinh viên</a>";
                    echo "<a href='../homework/up_homework.php'>Giao bài tập</a>";            
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
            <a class="active" href="qlsv.php">Cập nhật sinh viên</a>
            <a href="../user_info/adduser.php">Thêm sinh viên</a>
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Cập nhật sinh viên</a></div>
        <div class="info" style="overflow-x:auto; padding-left: 150px;">
<!--            <form action="qlsv.php" method ="post">        -->
              <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>User Name</th>
                  <th>Password</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($students as $item){$i++; ?>
                        <form action="qlsv.php" method ="post">
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><input style="width: 90%;" type="text" id="username" name="username" value="<?php echo $item['acc_username'];?>" ></td>
                            <td><input style="width: 90%;" type="password" id="password" name="password" value="<?php echo $item['acc_password'];?>"></td>
                            <td><input style="width: 90%;" type="text" id="fullname" name="fullname" value="<?php echo $item['acc_fullname'];?>"></td>
                            <td><input style="width: 90%;" type="text" id="email" name="email" value="<?php echo $item['acc_email'];?>"></td>
                            <td><input style="width: 90%;" type="text" id="phone" name="phone" value="<?php echo $item['acc_phone'];?>"></td>
                            <td>
<!--                                <button type="hidden" name="myItem" value="">Hidden</button>-->
                                <button type="submit" name="updateItem" value="<?php echo $item['acc_id'];?>">Edit</button>
                                <button type="submit" name="deleteItem" value="<?php echo $item['acc_id'];?>">Delete</button>
                            </td>
                        </tr>   
                        </form>
                  <?php } ?>
<!--//                        echo "<tr>";
//                        echo "<td>" . $i . "</td>";
//                        echo "<td>" . $input_username . "</td>";
//                        echo "</tr>";-->
           
              </table>
<!--            </form>-->
        </div>
       
   </body>
   
</html>
