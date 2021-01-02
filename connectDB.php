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
    $sql_create = "CREATE TABLE ACCOUNTS(
	acc_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	acc_username varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
	acc_password varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	acc_fullname varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	acc_email varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
	acc_phone varchar(255) COLLATE utf8_unicode_ci,
	acc_role int(11) NOT NULL)";
    
    $sql_insert = "INSERT INTO ACCOUNTS (acc_id, acc_username, acc_password, acc_fullname, acc_email, acc_phone, acc_role) VALUES
                                        (1, 'teacher1', '123456a@A', 'Nguyen Van A', 'uchiha1610@gmail.com', '0123456789', 0),
                                        (2, 'teacher2', '123456a@A', 'Nguyen Thi B', 'sharingan121@gmail.com', '0123456789', 0),
                                        (3, 'student1', '123456a@A', 'Nguyen Van C', 'songoku1995@gmail.com', '0123456789', 1),
                                        (4, 'student2', '123456a@A', 'Nguyen Thi D', 'bankai2020@gmail.com', '0123456789', 1)";
    // Hàm kết nối
    connect_db();
    
    // Câu truy vấn kiểm tra bảng có tồn tại không
    $sql_check = "SHOW TABLES LIKE 'ACCOUNTS'";
    $result = mysqli_query($conn, $sql_check);
    $rowcount=mysqli_num_rows($result);
    // Nếu chưa tồn tại 
    if($rowcount < 1){
        $query1 = mysqli_query($conn, $sql_create);
        $query2 = mysqli_query($conn, $sql_insert);
    }
    
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

?>