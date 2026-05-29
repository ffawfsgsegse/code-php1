<?php
        // kết nối database
    include "connect.php";

        // tạo ra 1 database mới biến có thể tự đặt
    // $cosodulieu = " CREATE DATABASE cosodulieu "; 

        // truy vấn đến cơ sở dữ liệu
    // if ( mysqlI_query($conn, $cosodulieu)){ // $cosodulieu là để tạo ra cái database mới
        // echo " Tạo database thành công";
    // }else {
        // echo " Thất bại";
    // }

        // tạo bảng
    // $taobang = " CREATE TABLE thanhvien (
    //     id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     taikhoan VARCHAR (30) NOT NULL,
    //     matkhau VARCHAR (30) NOT NULL,
    //     level INT (6)
    
    //  )";

        // thực thi truy vấn
    // if ($conn -> query($taobang)== TRUE){       // gọi biến $conn kết nối với dattabase , thực hiện câu lệnh query để tạo bảng mới
        // echo " Tạo bảng thành công";
    // }else{
        // echo " Thất bại";           // phải qua bên file connect chuyển phần database ="webcuatoi" thành database = "cosodulieu" 
    // }
    








?>