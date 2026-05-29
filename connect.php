<?php
        // phần kết nối với database
    $server = 'localhost';
    $user  = 'root';
    $pass = '';
    $database = 'cosodulieu';

        // biến dùng đẻ kết nối với $server -  $user - $pass - $database
    $conn = new mysqLi($server, $user, $pass, $database);

        // kiểm tra xem biến $conn đã kết nối hay chưa
    if($conn){
        mysqLi_query($conn, "SET NAMES 'utf8' ");
        echo " Đã kết nối thành công";
    }else {
        echo " Kết nối thất bại";
    }

?>