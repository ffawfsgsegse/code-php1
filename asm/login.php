<?php
    // liên kết với mysql
        include "connect.php";
    
         // tạo biến chữa lỗi
            $error ="";
            $error_tk = "";
            $error_mk = "";
    // kiểm tra nút đăng nhập
        if(isset($_POST['btn-login'])){
            // echo " ok";
        // bắt đầu validate
            $taikhoan = $_POST['username'];
            $matkhau = $_POST['password'];

        // validate không được để trống
            if(empty($taikhoan)|| empty($matkhau)){
                $error = " Tài khoản hoặc mật khẩu không được để trống";
            }
        // validate tài khoản
            if(empty($taikhoan)){
                $error_tk = " Tài khoản không được để trống";
            }elseif(strlen($taikhoan) < 8){
                $error_tk = " Tài khoản phải có độ dài lớn hơn 8 kí tự";
            }
        // validate mật khẩu
            if(empty($matkhau)){
                $error_mk = " Mật khẩu không được để trống";
            }elseif(strlen($matkhau) < 8){
                $error_mk = " Mật khẩu phải có độ dài hơn 8 Kí tự";
            }

        // validate - truy vấn tài khoản hoặc mật khẩu trùng khớp
            if(empty($error_tk) && empty($error_mk)){
        
            // tạo biến check trùng
                $trung_login = " SELECT * FROM thanhvien WHERE taikhoan='$taikhoan' AND matkhau='$matkhau' ";
                $kq_trung_login= mysqLi_query($ketnoi, $trung_login);
            // kết quả trả về từ database 

            if(mysqLi_num_rows($kq_trung_login)){
                // đăng nhập thành công
                echo "
                <script>
                        alert('Đăng nhập thành công! Chào mừng " . $taikhoan . " đã quay trở lại.');
                        window.location.href = 'products.php'; 
                    </script>
                    ";
                    exit();  // Dừng các dòng script bên dưới lại
            }else {
                // đăng nhập thất bại
                $error= "Tài khoản hoặc mật khẩu không chính xác! Vui lòng thử lại";
            }




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
        /* Container bọc các nút điều hướng bên dưới form */
        .navigation-box {
             margin-top: 20px;
             display: flex;
            flex-direction: column;
             align-items: center;
             gap: 15px; /* Tạo khoảng cách đều giữa các dòng */
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ================= ĐỊNH DẠNG NÚT ĐĂNG KÝ MỚI ================= */
        .btn-register-link {
         display: inline-block;
        width: 100%; /* Giúp nút kéo dài bằng nút Đăng Nhập phía trên */
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        color: #228be6; /* Màu chữ xanh */
        background-color: #e8f4fd; /* Nền xanh nhạt tạo sự phân cấp với nút Đăng Nhập */
     text-align: center;
     text-decoration: none; /* Bỏ gạch chân mặc định của thẻ a */
     border: 1px solid #74c0fc;
     border-radius: 8px; /* Bo góc mềm mại giống các ô input */
     box-sizing: border-box;
     transition: all 0.2s ease-in-out;
        }

     /* Hiệu ứng khi di chuột vào nút Đăng Ký (Hover) */
     .btn-register-link:hover {
        background-color: #228be6;
        color: #ffffff; /* Đổi màu nền và chữ ngược lại khi hover */
        box-shadow: 0 4px 12px rgba(34, 139, 230, 0.2);
        }

        /* Dòng chữ phụ dưới cùng */
        .text-sub {
        font-size: 14px;
        color: #868e96;
        }

        .text-sub a {
        color: #228be6;
        text-decoration: none;
        font-weight: 600;
        }
        .text-sub a:hover {
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
                <?php                  
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error_tk . "</h3>";                    
                ?>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." >
                <?php                  
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error_mk . "</h3>";                    
                ?>
            </div>
            <?php 
                 if (!empty($error)) {
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error . "</h3>";
                     } 
             ?>

            <button type="submit" name="btn-login" class="btn-login">Đăng Nhập</button>
            
            
             <!-- <button type="submit" name="btn-register" class="btn-register"> <a href = "register.php"> Đăng ký </a></button> -->
        </form>

        <div class="navigation-box">
            <!-- <a href="register.php" class="btn-register-link">Đăng Ký Tài Khoản Mới</a> -->
            
            <p class="text-sub">
                Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
            </p>
        </div>
    </div>

</body>
</html>