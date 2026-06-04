<?php
    // kết nối với file connect.php
        include "connect.php";

    // 1. bước tạo database mới
        // tự tạo 1 biến
            $bientutao = " CREATE DATABASE IF NOT EXISTS asm"; //   IF NOT EXISTS có nghĩa là: "Hãy tạo database tên là asm nếu nó chưa tồn tại; còn nếu nó đã có sẵn rồi thì bỏ qua và chạy tiếp code bên dưới

        // thực thi truy vấn đến mysql để tạo asm

            if(mysqLi_query($ketnoi, $bientutao)){
                echo"
                <script>
                alert(` Tạo database thành công ` );
                </script>
                ";
            }else {
                echo "
                <script>
                alert(` Tạo database thất bại `);
                </script>
                ";
            }

    // 2. tạo bảng sản phẩm trong mysql

        $taobang = " CREATE TABLE IF NOT EXISTS sanpham(
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ten VARCHAR (50) NOT NULL,
            gia DECIMAL (10, 0) NOT NULL ,
            anh TEXT NOT NULL,
            danhmuc VARCHAR (200) NOT NULL
        )";

        // thực thi xem đã tạo  bảng  thành công hay chưa

        if($ketnoi -> query($taobang)==TRUE){
            echo "
            <script>
            alert (` Đã tạo bảng thành công `);
            </script>
            ";
        }else {
            echo "
            <script>
            alert (` Không tạo được bảng `);
            </script>
            ";
        }

        $taobang = "CREATE TABLE IF NOT EXISTS thanhvien (
            id INT (6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            taikhoan VARCHAR (30) NOT NULL,
            matkhau VARCHAR (30) NOT NULL
        )";

        mysqLi_query($ketnoi, $taobang);
    // 3. thêm sản phẩm vào
        // thêm dữ liệu vào bảng, các biến này tự tạo ra
       
            
        //    $id =""; 
        //     $ten ="Luffy";
        //     $gia ="30000";
        //     $anh = 'https://i.ibb.co/xtd6qzVS/30c495f7ce30739e4757c4b327ee1fad.jpg';
        //     $danhmuc ='Thời Trang';
           
          
            $id =""; 
            $ten ="Nami";
            $gia ="290";
            $anh = 'https://i.ibb.co/LDDhZgys/00a12c82e2173dd2a20a5593b2d1c120.jpg';
            $danhmuc ='Thời Trang';
            
        //kiểm tra xem có  sản phẩm đó hay chưa
            $them_kt = "SELECT * FROM sanpham WHERE ten ='$ten'";
            $kq_them_kt = mysqLi_query($ketnoi, $them_kt);
        // nếu chưa tồn tại ( số dòng trả vè 0) thì mới thực hiện tiếp
            if(mysqLi_num_rows($kq_them_kt)==0){
                // thực hiện hàm thêm
                 $themsanpham = "INSERT INTO  sanpham ( ten, gia, anh, danhmuc)
                            VALUES ( '$ten', '$gia', '$anh', '$danhmuc')
            ";
                // thực hiện truy vấn
                    if(mysqLi_query($ketnoi, $themsanpham)){
                        echo "
                        <script>
                        alert(` Thêm sản phẩm thành công `);
                        </script>
                        ";
                    }else {
                        echo "
                        lỗi thêm sản phẩm
                        " . mysqLi_query($ketnoi);
                    }
            
            
            }else {
                echo "
                <script>
                alert (` Sản phẩm '$ten' đã tổn tại;
                </script>
                ";
            }
           
        

        // tạo 1 mảng danh sách

            // $danhsach = [
            //     [
            //     'ten' => 'Luffy',
            //     'gia' => '300',
            //     'anh' =>  'https://i.ibb.co/xtd6qzVS/30c495f7ce30739e4757c4b327ee1fad.jpg',   
            //     'danhmuc' => 'Thời Trang',
            //     ],
            //     [
            //     'ten' => 'Zozo',
            //     'gia' => '290',
            //     'anh' =>  'https://i.ibb.co/ZRBGCdhT/ddb695e7b127e2889899bdcebe6ef830.jpg' ,  
            //     'danhmuc' => 'Thời Trang',
            //     ],
            //     [
            //     'ten' => 'Nami',
            //     'gia' => '100',
            //     'anh' =>  'https://i.ibb.co/LDDhZgys/00a12c82e2173dd2a20a5593b2d1c120.jpg',   
            //     'danhmuc' => 'Phụ Kiện',
            //     ],
            //     [
            //     'ten' => 'Robin',
            //     'gia' => '400',
            //     'anh' =>  'https://i.ibb.co/Kx0n0QCq/88e05f43f3011a40975892cbb789777e.jpg',   
            //     'danhmuc' => 'Phụ Kiện',
            //     ],
            //     [
            //     'ten' => 'SanJi',
            //     'gia' => '150',
            //     'anh' =>  'https://i.ibb.co/3mpxGG6B/6a7466e1509efcf4f6d4960f13f3f727.jpg',   
            //     'danhmuc' => 'Công Nghệ',
            //     ],
            //     [
            //     'ten' => 'FranKy',
            //     'gia' => '500',
            //     'anh' =>  'https://i.ibb.co/B2pdXhNS/383ef2000ab7557b4b52b68e35176195.jpg',   
            //     'danhmuc' => 'Công Nghệ',
            //     ],
            //     [
            //     'ten' => 'Shanks',
            //     'gia' => '600',
            //     'anh' =>  'https://i.ibb.co/jkJWrJYb/840c954aba9a2d9e140fce58290fe3f6.jpg',  
            //     'danhmuc' => 'Gia dụng',
            //     ],
            //     [
            //     'ten' => 'HanCook',
            //     'gia' => '800',
            //     'anh' =>  'https://i.ibb.co/KzmmMqGV/3e6182b3c74af96ab2a19a33a96450d4.jpg' ,  
            //     'danhmuc' => 'Gia dụng',
            //     ],
            // ];
        
       

?>