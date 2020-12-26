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
	acc_phone int(11),
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
