<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //include('session.php');
    require '../connectDB.php';
    require '../Util.php';
    require '../homework/download.php';
    require '../game/checker.php';
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
    
    $chall = get_all_challenge();

    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {     
        if(isset($_POST['clg_submit']) AND is_numeric($_POST['clg_submit'])){
            $clg_id = filter_input(INPUT_POST, 'clg_submit');
            $clg_result = filter_input(INPUT_POST, 'clg_result');
            $isTrue = check_result_challenge($clg_id, $clg_result);
            if($isTrue === TRUE){
                $msg = "Congratulation !!!";
                $challenge_result = strtolower($clg_result);
                $final_location = "final.php?id=" . $clg_id . "&" . "clg=" . $challenge_result;
                phpAlert2($msg, $final_location);
            }else{
                $msg = "Failed !!!";
                phpAlert($msg);
            }
        }
    }
//    echo "<meta http-equiv='refresh' content='0'>";
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
            <a href="../msg/inbox.php">Hòm thư</a>
            <a class="active" href="../game/game.php">Game</a>
            <div class="topnav-right">
                <a style="color: crimson"><?php echo $role . ": ". $login_name; ?></a>
                <a href = "../login/logout.php">Sign Out</a>
            </div>
        </div>
        <div class="tab">
            <a class="active" href="../game/game.php">Challenge</a>
            <?php 
                if($login_role == 0){
                    echo "<a href='../game/upchall.php'>Upload Challenge</a>";            
                }
            ?>            
        </div>
        <div><a style="color:#45a049;font-size: 50px;">Challenge</a></div>
        <div class="info" style="overflow-x:auto; overflow-y: auto; padding-left: 150px;">
            <table>
                <tr style="background-color: #006600; color: pink;">
                  <th>Challenge</th>
                  <th>Hint</th>
                  <th>Result</th>
                  <th>Submit</th>
                </tr>
                <?php
                    $i=0;
                    foreach ($chall as $item){
                        $i++; 
                        $clg_hint = $item['game_hint'];
                ?>
                <form method="POST" action="../game/game.php">
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $clg_hint;?></td>
                            <td><input style="width: 90%;" type="text" id="clg_result" name="clg_result"></td>
                            <td><button type="submit" name="clg_submit" value="<?php echo $item['game_id'];?>">Submit</button></td>
                        </tr>   
                </form>
                  <?php } ?> 
            </table>
        </div>
   </body>
   
</html>