<?php /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require '../connectDB.php';
    require '../Util.php';
    session_start();
    //Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
    $db = connect_db();
//    if($_SERVER["REQUEST_METHOD"] === "POST") {
//        // username and password sent from form
//        $myusername = mysqli_real_escape_string($db,$_POST['username']);
//        $mypassword = mysqli_real_escape_string($db,$_POST['password']);
//    }
    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') === "POST") {
        // username and password sent from form 
        // Dùng hàm mysql_real_escape_string() để loại bỏ những kí tự có thể gây ảnh hưởng đến câu lệnh SQL
        $myusername = mysqli_real_escape_string($db,filter_input(INPUT_POST, 'username'));
        $mypassword = mysqli_real_escape_string($db,filter_input(INPUT_POST, 'password'));
        $teacherbox= filter_input(INPUT_POST, 'teacher');
        //echo $myusername;
        //echo $mypassword;
        //echo $teacherbox;
        if ($teacherbox == "on"){
            $sql = "SELECT acc_id FROM ACCOUNTS WHERE acc_username = '$myusername' and acc_password = '$mypassword' and acc_role = 0";
        } else{
            $sql = "SELECT acc_id FROM ACCOUNTS WHERE acc_username = '$myusername' and acc_password = '$mypassword' and acc_role = 1";
        }
        $result = mysqli_query($db,$sql);
        // Associative array
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1) {
        //session_register("myusername");
        // $_SESSION là nơi SESSION lưu trữ thông tin - cũng chính là dữ liệu phục hồi được giữa các trang, 
        // Truy cập biến này trong suốt vòng đời của session để lấy, lưu trữ thông tin. 
        // Nên dùng hàm isset() để kiểm tra một biến session nào đó đã có hay chưa.
            $_SESSION['login_user'] = $myusername;   
//            if($teacherbox == "on"){
//                header("location: welcome.php");
//            } else {
//                header("location: students.php");
//            }
            header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
         phpAlert($error);
      }
    }
?>
<html>
    <header>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="login.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </header>
    <body>
        <div align = "center">
            <div style = "width:300px; border: solid 1px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
                <div style = "margin:30px">
                    <form action = "login.php" method = "post" class="dangnhap" >
                        <label>UserName  :</label>
                        <input type = "text" name = "username" class = "box"/><br><br>
                        <label>Password  :</label>
                        <input type = "password" name = "password" class = "box" /><br><br>
                        <label>I am Teacher </label>
                        <input type="checkbox" name="teacher" ><br><br> 
                        <input type = "submit" value = " Login "/><br>
                    </form>
                    <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>               
                </div>
            </div>
        </div>
    </body>
</html>

