<?php

    include "connectt.php";
    //1. tạo biến tự đặt
        $bientutao= "CREATE DATABASE IF NOT EXISTS cosodulieu";   // bước tạo database, CREATE DATABASE IF NOT EXISTS có nghĩa là: "Hãy tạo database tên là cosodulieu nếu nó chưa tồn tại; còn nếu nó đã có sẵn rồi thì bỏ qua và chạy tiếp code bên dưới

    // 2. thực thi truy vấn dế có sở dữ liệu trong mysql

        if(mysqLi_query($ketnoi, $bientutao)){
            echo " tạo database thành công <br>"; 
        }else{
            echo " tạo database thất bại <br>";
        }

    // 3. tạo 1 biến khác, để làm biến tạo bảng
            // CREATE TABLE IF NOT EXISTS chưa có thì hãy tạo mới, còn nếu có rồi thì cứ bỏ qua và chạy tiếp
        $taobang = " CREATE TABLE IF NOT EXISTS thanhvien (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,  
            taikhoan VARCHAR(30) NOT NULL,
            matkhau VARCHAR(30) NOT NULL,
            lever INT(6)
        )"; //UNSIGNED AUTO_INCREMENT tăng tự động id lên theo

        // thực thi truy vấn xem đã tạo bảng thành công hay chưa

        if($ketnoi -> query($taobang)== TRUE){   // gọi biến $ketnoi để kết nối với database,  còn query($taobang) để tạo ra cái bảng
            echo " Tạo bảng thành công <br>";
        }else {
            echo " Tạo bảng thất bại <br>";    // đến  bước này phải xem bên file connect.php đã để hiện database = " cosodulieu" hay chưa
        }

            // tạo thêm 1 bảng sản phẩm
        $bangsanpham = " CREATE TABLE IF NOT EXISTS sanpham(
            id INT (6)UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR (50) NOT NULL,
            image VARCHAR (150) NOT NULL,
            price INT (10)

        )";

        if($ketnoi -> query($bangsanpham)==TRUE){
            echo " tạo bảng thành công";
        }else {
            echo " tạo bảng thất bại";
        }
    

    

    // 4. thêm dữ liệu vào bảng
        // $id =""; 
        // $taikhoan ="admin";
        // $matkhau ="123";
        // $lever = 1; // không cho vào "" thì sẽ thành dạng chuỗi
                                                // id , taikhoan ,matkhau, lever ở dòng dưới đại diện cho trường dữ liệu trong mysql
                                                // còn VALUE('$id','$taikhoan','$matkhau','$lever')  đại diện cho dòng thêm dữ liệu vào bảng (dòng 32)
        // $themdulieu = " INSERT INTO thanhvien (id, taikhoan, matkhau, lever) 
        //     VALUE('$id','$taikhoan','$matkhau','$lever')
        // ";

    // thực hiện truy vấn, cho câu lệnh thêm dữ liệu chạy

        // mysqLi_query($ketnoi, $themdulieu); // mỗi lần f5 load lại trang thêm 1 lần trường dữ liệu
        
// 5.Chỉ thực hiện thêm dữ liệu KHI người dùng bấm nút có name="btn-submit" từ Form gửi lên
// if (isset($_POST['btn-submit'])) {
//     $taikhoan = $_POST['username'];
//     $matkhau = $_POST['password'];
//     $lever = 1;

//     $themdulieu = "INSERT INTO thanhvien (taikhoan, matkhau, lever) 
//                    VALUES ('$taikhoan', '$matkhau', '$lever')";

//     mysqli_query($ketnoi, $themdulieu);
    
//     echo "Thêm thành viên thành công!";
// }

    //6. thêm dữ liệu, xem đã tồn tại chưa trước khi chèn

        $id ="";
        $taikhoan = "admin";
        $matkhau = "123";
        $lever ="1";

    // tạo 1 mảng chứa danh sách

        $danhsach = [
            ['taikhoan' => 'luffy', 'matkhau' => '123a', 'lever' => '2'],
            ['taikhoan' => 'zozo', 'matkhau' => '123b', 'lever' => '3'],
        ];
    // dùng vòng lặp forech để tự động duyệt
        foreach ($danhsach as $a){
            $taikhoan = $a['taikhoan'];
            $matkhau = $a['matkhau'];
            $lever = $a['lever'];
       

    // kiểm tra xem tài khoản này đã có trong database hay chưa

    $check_tk = "SELECT * FROM thanhvien where taikhoan = '$taikhoan'";
    $kq_check_tk = mysqLi_query ($ketnoi, $check_tk);

    // kiểm tra trùng lặp trước khi thêm mới
        if(mysqLi_num_rows($kq_check_tk) > 0){      //mysqLi_num_rows dếm số dòng dữ liệu có trong biến $kq_check_tk
            echo " Tài khoản '$taikhoan' đã tồn tại, không thêm nữa <br>";
        }else {
            // nếu chưa có thì thêm vào
            $themdulieu = "INSERT INTO thanhvien (taikhoan, matkhau, lever) 
                            VALUE ('$taikhoan','$matkhau','$lever')"; // không thêm biến id vào, vì biến id đã tự động tăng lên
            mysqLi_query ($ketnoi, $themdulieu);
            echo " thêm tài khoàn thành công <br>";
        }
        }
    
    
    // 7. lấy dữ liệu trong mysql

        $laydulieu = "SELECT * FROM thanhvien";
        $kq_laydulieu = mysqLi_query($ketnoi, $laydulieu);   // thực thi câu lệnh
            echo" dữ liệu là: ".  mysqLi_num_rows($kq_laydulieu) ."<br>";    //mysqLi_num_rows($kq_laydulieu) đếm xem trong mysql có bao nhiêu dữ liệu

    // in dữ liệu ra màn hình
        if(mysqLi_num_rows($kq_laydulieu) > 0){
            // vòng lặp while sẽ chạy để lấy dữ liệu ra
            while($indulieu = mysqLi_fetch_array($kq_laydulieu)){
                echo "ID:". $indulieu['id']."| Tài khoản : " .$indulieu['taikhoan']." | Mật khẩu :".$indulieu["matkhau"]." | lever :".$indulieu["lever"]."<br>";
            }                      
        }else {
                echo " bảng chưa có dữ liệu nào <br>";
            }

    //8.  xóa dữ liệu trong mysql

        $xoadulieu ="DELETE  FROM thanhvien where id ='12' ";

    // chạy câu lệnh
        mysqLi_query($ketnoi, $xoadulieu);  
    
    //9. sửa dữ liệu

        $id = 1 ;
        $taikhoan = 'nami';
        $matkhau = '111';
        $lever = 6;

        $suadulieu = " UPDATE thanhvien SET id='$id' , taikhoan='$taikhoan' , matkhau='$matkhau' , lever='$lever'  WHERE id= 13 ";

        mysqLi_query($ketnoi, $suadulieu);

    // 10. chèn html vào mysql

        $chenhtml = "SELECT * FROM thanhvien";
        $kq_chenhtml = mysqLi_query($ketnoi, $chenhtml);

        while( $inhtml = mysqLi_fetch_array($kq_chenhtml)){
           
             echo $inhtml['taikhoan']."<br>";

        }







?>