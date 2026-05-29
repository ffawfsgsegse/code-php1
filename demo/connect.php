<?php
    // khai báo thông tin cấu hình ban đầu

        $sever = "localhost";
        $user = "root";    // mặc định trong xampp là " root "
        $pass = "";            // mặc định trong xampp là rỗng ""
        $database = "cosodulieu";

        // tạo biến kết nối đến mysql sever ( chưa chọn database vì chưa tạo song)

        $ketnoi = new mysqli($sever, $user, $pass, $database);

        // check xem đã kết nối thành công hay chưa

        if($ketnoi){
            mysqli_query($ketnoi, "SET NAMES 'utf8' ");
            echo " đã kết nối thành công";
        }else {
            echo " Đã kết nối thất bại";
        }

?>