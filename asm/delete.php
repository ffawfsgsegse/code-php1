<?php
    // gọi database
        include "connect.php";

    // gọi biến xoa_id ở dòng 121 bên file product.php
        $xoa_id = $_GET['xoa_id'];
        echo " $xoa_id";

        // tạo biến để xóa

        $xoa = " DELETE  FROM sanpham WHERE id='$xoa_id' ";

        // thực thi truy vấn câu lệnh ở trên

        mysqLi_query($ketnoi, $xoa);
         
        //  quay về trang chủ là product

        header("location: products.php");
?>