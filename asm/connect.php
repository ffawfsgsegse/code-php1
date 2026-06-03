<?php
    // khai báo thông tin ban đầu
        $sever = 'localhost';
        $user = 'root';
        $pass = '';
        $database = "asm";

    // biến tự tạo ra để kết nối đến mysql 
        $ketnoi= new mysqli($sever, $user, $pass, $database);

    // check xem đã kết nối được hay chưa
        if($ketnoi){
            mysqLi_query($ketnoi, "SET NAMES 'utf8'");
            // echo " 
            //     <script>
            //     alert(` Đã kết nối thành  công `);
            //     </script>            
            // ";
        }else {
            echo "
                <script>
                alert (` Kết nối thất bại `);                
                </script>
            ";
        }


?>