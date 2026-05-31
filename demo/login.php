<?php

    include "connectt.php";

    //1. bắt sự kiện khi sử dụng nút đăng nhập

        // kiểm tra nút đăng nhập có tồn tại hay không
                if(isset($_POST['btn-login'])){
                    echo " thành công";

            // validate form đăng nhập
                $taikhoan =  trim($_POST['username']);
                $matkhau = trim($_POST['password']);

            // biến error dùng để chứa lỗi
                $error ='';

            // kiểm tra điều kiện đăng nhập cơ bản

                if(empty($taikhoan) || empty($matkhau)){
                    $error = "Tài khoản hoặc mật khẩu không được để trống!";
                     echo "<script>alert('" . $error . "');</script>";
                }
            
    // truy vấn tài khoản hoặc mật khẩu trùng khớp
            // tạo biến để check trùng
                $trung_login =" SELECT * FROM thanhvien WHERE taikhoan='$taikhoan' AND matkhau='$matkhau' ";
                $kq_trung_login = mysqLi_query($ketnoi, $trung_login);
            // kết quả trả về từ database

                if(mysqLi_num_rows($kq_trung_login)){
                    // đăng nhập thành công
                    echo "
                    <script>
                        alert('Đăng nhập thành công! Chào mừng " . $taikhoan . " đã quay trở lại.');
                        window.location.href = 'tao-database.php'; 
                    </script>
                    ";
                    exit();  // Dừng các dòng script bên dưới lại
                }else {
                    // đăng nhập thất bại
                        echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác! Vui lòng thử lại.');</script>";
                }


            

            // in lỗi ra màn hình
            if(!empty($error)){
                echo "<script>alert('" . $error . "');</script>";
            }else {




        // // kiểm tra xem có trùng trong mysql hay không
        //             $taikhoan =  $_POST['username'];  // dữ liệu này lấy ở "name" phần form tài khoản hoặc là username
        //             $matkhau = $_POST['password'];      // dữ liệu này lấy ở "name" phần form mất khẩu hoặc là password
        // // tạo biến để check trùng
        //             $trung_login = " SELECT * FROM thanhvien WHERE taikhoan ='$taikhoan' AND matkhau ='$matkhau' ";

        //             $kq_trung_login = mysqLi_query($ketnoi , $trung_login);
                
        //         if(mysqLi_num_rows($kq_trung_login)==1){
        //             header("location: tao-database.php");
        //         }else{
        //             echo " tài khoản hoặc mật khẩu sai";
        //         }


                }


                }







?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <style>
        /* --- PHẦN CSS (Giao diện) --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333333;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            color: #666666;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-group input:focus {
            border-color: #007bff;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #0056b3;
        }

        .footer-links {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        .footer-links a {
            color: #007bff;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>ĐĂNG NHẬP</h2>
        
        <form action="login.php" method="POST">
            
            <div class="input-group">
                <label for="username">Tài khoản</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản..." >
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." >
            </div>

            <button type="submit" name="btn-login" class="btn-login">Đăng Nhập</button>
            
             <button type="submit" name="btn-register" class="btn-register"> <a href = "register.php"> Đăng ký </a></button>
        </form>

        <div class="footer-links">
            <p>Chưa có tài khoản? <a href="#">Đăng ký ngay</a></p>
        </div>
    </div>

</body>
</html>