<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Biến kết nối toàn cục
global $conn;
// Hàm kết nối database
function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    $hostname = 'localhost:3306';
    $username = 'root';
    $password = '';
    $dbname = "qlsv_db";
    
    //$hostname = 'localhost';
    //$username = 'id15742785_root';
    //$password = 'a##S4+4/B]g2D/~A';
    //$dbname = "id15742785_qlsv_db";
    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn){
        $conn = mysqli_connect($hostname, $username, $password, $dbname) or die ('Can\'t not connect to database');
        // Thiết lập font chữ kết nối
        mysqli_set_charset($conn, 'utf8');
    }
    return $conn;
}

// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn){
        mysqli_close($conn);
    }
}

// Hàm ngắt kết nối
function init_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    $sql_create = "CREATE TABLE IF NOT EXISTS ACCOUNTS(
	acc_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	acc_username varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
	acc_password varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	acc_fullname varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	acc_email varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
	acc_phone varchar(255) COLLATE utf8_unicode_ci,
	acc_role int(11) NOT NULL)";
    
    $sql_create2 = "CREATE TABLE IF NOT EXISTS MSG(
	msg_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	msg_msg varchar(255) COLLATE utf8_unicode_ci,
	msg_idsender int(11) NOT NULL,
	msg_idrecver int(11) NOT NULL,
        msg_time varchar(255) COLLATE utf8_unicode_ci,
        FOREIGN KEY (msg_idsender) REFERENCES ACCOUNTS(acc_id),
        FOREIGN KEY (msg_idrecver) REFERENCES ACCOUNTS(acc_id)
        )";
    
    $sql_create3 = "CREATE TABLE IF NOT EXISTS HOMEWORKS(
	hw_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	hw_title varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
        hw_path varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
	hw_teacherid int(11) NOT NULL,
        hw_uptime varchar(255) COLLATE utf8_unicode_ci,
        FOREIGN KEY (hw_teacherid) REFERENCES ACCOUNTS(acc_id)
        )";
        
    $sql_create4 = "CREATE TABLE IF NOT EXISTS RESULTS(
	kq_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	kq_studentid int(11) NOT NULL,
	kq_homeworkid int(11) NOT NULL,
        kq_path varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
        kq_uptime varchar(255) COLLATE utf8_unicode_ci,
        FOREIGN KEY (kq_studentid) REFERENCES ACCOUNTS(acc_id),
        FOREIGN KEY (kq_homeworkid) REFERENCES HOMEWORKS(hw_id)
        )";
    
    $sql_create5 = "CREATE TABLE IF NOT EXISTS GAME(
	game_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        game_hint varchar(255) COLLATE utf8_unicode_ci NOT NULL
        )";
    
    $sql_insert = "INSERT INTO ACCOUNTS (acc_id, acc_username, acc_password, acc_fullname, acc_email, acc_phone, acc_role) VALUES
                                        (1, 'teacher1', '123456a@A', 'Nguyen Van A', 'uchiha1610@gmail.com', '0123456789', 0),
                                        (2, 'teacher2', '123456a@A', 'Nguyen Thi B', 'sharingan121@gmail.com', '0123456789', 0),
                                        (3, 'student1', '123456a@A', 'Nguyen Van C', 'songoku1995@gmail.com', '0123456789', 1),
                                        (4, 'student2', '123456a@A', 'Nguyen Thi D', 'bankai2020@gmail.com', '0123456789', 1)";
    // Hàm kết nối
    connect_db();
    $query1 = mysqli_query($conn, $sql_create);
    $query2 = mysqli_query($conn, $sql_create2);
    $query3 = mysqli_query($conn, $sql_create3);
    $query4 = mysqli_query($conn, $sql_create4);
    $query5 = mysqli_query($conn, $sql_create5);
    
    $query = mysqli_query($conn, $sql_insert);
////    // Câu truy vấn kiểm tra bảng có tồn tại không
//    $sql_check = "SHOW TABLES LIKE 'ACCOUNTS'";
//    $result = mysqli_query($conn, $sql_check);
//    $rowcount=mysqli_num_rows($result);
//    // Nếu chưa tồn tại 
//    if($rowcount < 1){
//        $query1 = mysqli_query($conn, $sql_create);
//        $query2 = mysqli_query($conn, $sql_create2);
//        $query3 = mysqli_query($conn, $sql_insert);
//    }
    
    disconnect_db();
    //return $query2; 
}

// Hàm thêm sinh viên
function add_student($add_username, $add_password, $add_fullname, $add_email, $add_phone)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $username = addslashes($add_username);
    $password = addslashes($add_password);
    $fullname = addslashes($add_fullname);
    $phone = addslashes($add_phone);
    $email = addslashes($add_email);
     
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO ACCOUNTS(acc_username, acc_password, acc_fullname, acc_email, acc_phone, acc_role) VALUES
            ('$username','$password','$fullname','$email','$phone', 1)";
    $sql_u = "SELECT * FROM ACCOUNTS WHERE acc_username='$username'";
    $sql_e = "SELECT * FROM ACCOUNTS WHERE acc_email='$email'"; 
    $res_u = mysqli_query($conn, $sql_u);
    $res_e = mysqli_query($conn, $sql_e);
    
    if ((mysqli_num_rows($res_u) > 0) or (mysqli_num_rows($res_e) > 0)) {
        $error = "Sorry... username or email already taken"; 	 	
    }else{
//       $query = "INSERT INTO users (username, email, password) 
//              VALUES ('$username', '$email', '".md5($password)."')";
        $query = mysqli_query($conn, $sql);
        $error = "Add OK !!!";
    }
    Alert($error);   
}

// Hàm sửa sinh viên
function edit_student($student_id, $edit_username, $edit_password, $edit_fullname, $edit_email, $edit_phone)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Chống SQL Injection
    $username = addslashes($edit_username);
    $password = addslashes($edit_password);
    $fullname = addslashes($edit_fullname);
    $email = addslashes($edit_email);
    $phone = addslashes($edit_phone);
    $sql = "
        UPDATE ACCOUNTS SET
        acc_username = '$username',
        acc_password = '$password',
        acc_fullname = '$fullname',
        acc_email = '$email',
        acc_phone = '$phone'
        WHERE acc_id = '$student_id'";
    $checknew = mysqli_query($conn,"select * from ACCOUNTS where acc_id = '$student_id' ");
    // Check New
    $row = mysqli_fetch_array($checknew,MYSQLI_ASSOC);
    $login_name = $row['acc_username'];
    $login_fullname = $row['acc_fullname'];
    $login_email = $row['acc_email'];
    $login_phone = $row['acc_phone'];
    $login_pass = $row['acc_password'];
    
    $sql_u = "SELECT * FROM ACCOUNTS WHERE acc_username='$username' AND acc_id != '$student_id'";
    $sql_e = "SELECT * FROM ACCOUNTS WHERE acc_email='$email' AND acc_id != '$student_id'"; 
    $res_u = mysqli_query($conn, $sql_u);
    $res_e = mysqli_query($conn, $sql_e);
    
    if ((mysqli_num_rows($res_u) > 0) or (mysqli_num_rows($res_e) > 0)) {
        $error = "Sorry... username or email already taken"; 	 	
    }elseif(($login_name === $edit_username) and ($login_pass === $edit_password) and ($login_fullname === $edit_fullname)and ($login_email === $edit_email)and ($login_phone === $edit_phone)){
        $error = "Nothing changes";
    }else{  
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql); 
        $error = "Edit OK";        
    }
    Alert($error);

}

function Alert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

// Hàm xóa sinh viên
function delete_student($student_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    // Delete all foreign key in table
    delete_usermsg($student_id);
    delete_userrs($student_id);
    // Câu truy van
    $sql = "
            DELETE FROM ACCOUNTS
            WHERE acc_id = $student_id
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

// Hàm lấy tất cả sinh viên
function get_all_students()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from ACCOUNTS where acc_role=1 ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

// Hàm lấy tất cả sinh viên
function get_all_users($id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from ACCOUNTS where acc_id!=$id";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

function get_user($id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from ACCOUNTS where acc_id=$id";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

    return $row;
}

function sendmsg($add_msg, $add_sender, $add_recver, $add_time){
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Chống SQL Injection
    $msg = addslashes($add_msg);
    $sender = addslashes($add_sender);
    $recver = addslashes($add_recver);
    $time = addslashes($add_time);
     
    $sql = "INSERT INTO MSG(msg_msg, msg_idsender, msg_idrecver, msg_time) VALUES
            ('$msg','$sender','$recver','$time')";

    $query = mysqli_query($conn, $sql);  
    $error = "Send OK";        
    Alert($error);
}

function get_all_msg($msgid, $in_out){
    
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    if($in_out === "outbox"){
        $sql = "select * from MSG where msg_idsender=$msgid";
    } else {
        $sql = "select * from MSG where msg_idrecver=$msgid";
    }
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    
    // Trả kết quả về
    return $result;
}

function delete_msg($delete_id){
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "
            DELETE FROM MSG
            WHERE msg_id = $delete_id
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function delete_usermsg($user_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    // Câu truy van
    $sql = "
            DELETE FROM MSG
            WHERE msg_idsender = $user_id OR msg_idrecver=$user_id
    ";
    
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}
//
//function delete_userhw($user_id)
//{
//    // Gọi tới biến toàn cục $conn
//    global $conn;
//    
//    // Hàm kết nối
//    connect_db();
//    
//    // Câu truy van
//    $sql = "
//            DELETE FROM HOMEWORKS
//            WHERE hw_teacherid = $user_id
//    ";
//    
//    // Thực hiện câu truy vấn
//    $query = mysqli_query($conn, $sql);
//    
//    return $query;
//}

function delete_userrs($id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "
    DELETE FROM RESULTS
    WHERE kq_studentid = $id
    ";
   
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}


function add_homework($title, $path, $teacherid){
    global $conn;
    
    connect_db();
    // Chống SQL Injection
    $add_title = addslashes($title);
    $add_path = addslashes($path);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date("h:i:sa d-m-Y");
    
    $sql = "
        INSERT INTO HOMEWORKS(hw_title, hw_path, hw_teacherid, hw_uptime) VALUES
        ('$add_title','$add_path','$teacherid', '$time')";
    
    $sql_t = "SELECT * FROM HOMEWORKS WHERE hw_title='$add_title'";
    $sql_p = "SELECT * FROM HOMEWORKS WHERE hw_path='$add_path'"; 
    
    $res_t = mysqli_query($conn, $sql_t);
    $res_p = mysqli_query($conn, $sql_p);
    $error = null;
    if ((mysqli_num_rows($res_t) > 0) or (mysqli_num_rows($res_p) > 0)) {
        $error = "Sorry... File or Title already taken"; 	 	
    }else{
        $query = mysqli_query($conn, $sql);
        $error = "Upload OK !!!";
    }
    
    return $error;
    
}

function add_result($uploader_id,$homeworkid, $dest_homework){
    global $conn;
    
    connect_db();
    // Chống SQL Injection
    $add_path = addslashes($dest_homework);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date("h:i:sa d-m-Y");
    $sql = "
        INSERT INTO RESULTS(kq_studentid, kq_homeworkid, kq_path, kq_uptime) VALUES
        ('$uploader_id','$homeworkid','$dest_homework', '$time')";
    
    $sql_t = "SELECT * FROM RESULTS WHERE kq_path='$dest_homework'";
    $res_t = mysqli_query($conn, $sql_t);
    if ((mysqli_num_rows($res_t) > 0)) {
        $error = "Sorry... Homework already submited"; 	 	
    }else{
        $query = mysqli_query($conn, $sql);
        $error = "Upload OK !!!";
    }
    
    return $error;
}

function get_all_homeworks(){
        // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from HOMEWORKS";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    // Trả kết quả về
    return $result;
}

function get_homeworks($homework_id){
        // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from HOMEWORKS where hw_id=$homework_id";
    // Thực hiện câu truy vấn
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query,MYSQLI_ASSOC);

    return $row;
}

function get_all_result(){
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from RESULTS";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    // Trả kết quả về
    return $result;
}

function get_result($student_id){
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from RESULTS where kq_studentid=$student_id";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    // Trả kết quả về
    return $result;
}

function delete_result($result_id){
        // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "
    DELETE FROM RESULTS
    WHERE kq_id = $result_id
    ";
   
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    return $query;
}

function add_challenge($hint){
    global $conn;
    
    connect_db();
    // Chống SQL Injection
    $add_hint = addslashes($hint);

    $sql = "INSERT INTO GAME(game_hint) VALUES ('$add_hint')";
        $query = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);
    return ($id);
}

function get_all_challenge(){
    // Gọi tới biến toàn cục $conn
    global $conn;
    
    // Hàm kết nối
    connect_db();
    
    $sql = "select * from GAME";
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    
    // Mảng chứa kết quả
    $result = array();
    
    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    // Trả kết quả về
    return $result;
}

?>