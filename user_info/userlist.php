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
    $users = get_all_users($login_id);
                    
    if($login_role == 0){
        $role = "Teacher";
    } else{
        $role = "Student";
    }

    if(!isset($_SESSION['login_user'])){
       header("location:login.php");
       die();
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
            <a class='active' href="../user_info/userlist.php">Danh sách người dùng</a>
            <?php 
                if($login_role == 0){
                    echo "<a href='../user_info/qlsv.php'>Quản lý Sinh viên</a>";
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
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Danh sách người dùng</a></div>
        <div class="info" style="overflow-x:auto; padding-left: 150px;">
              <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>STT</th>
                  <th>User Name</th>
                  <th>Full Name</th>
                  <th>Role</th>
                  <th>Details</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($users as $item){
                        $i++; 
                        if($item['acc_role'] == 0){
                            $user_role = "Teacher";
                        } else{
                            $user_role = "Student";
                        }
                        $acc_idrow=$item['acc_id'];
                ?>
                        <form action="qlsv.php" method ="post">
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item['acc_username'];?></td>
                            <td><?php echo $item['acc_fullname'];?></td>
                            <td><?php echo $user_role;?></td>
                            <td><a href="../user_info/msg.php?acc_row=<?php echo $acc_idrow; ?>">Details</a></td>
                        </tr>   
                        </form>
                  <?php } ?>      
              </table>
        </div>
       
   </body>
   
</html>
