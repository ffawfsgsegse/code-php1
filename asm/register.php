<?php
    include "connect.php";
    $error = ""; // dùng để chứa lỗi
    $error_taikhoan = "";
    $error_matkhau = "";
    $error_re_matkhau="";

    if(isset($_POST['btn-register'])){
        // echo ' ok';
    
        // gọi các biến để bắt đầu validate
            $taikhoan = $_POST['username'];
            $matkhau = $_POST['password'];
            $re_matkhau = $_POST['re-password'];

            // tài khoản hoặc mật khẩu không được để trống
            if (empty ($taikhoan) || empty($matkhau) || empty($re_matkhau)){
                $error= " Tài khoản hoặc mật khẩu không được để trống";
            
            // validate phần tài khoản
                if(empty($taikhoan)) {
                    $error_taikhoan = " Tài khoản không được để trống";
                }elseif (strlen($taikhoan) < 8){
                    $error_taikhoan = " Tài khoản phải lớn hơn 8 kí tự";
                }
            // validate phần mật khẩu
                if(empty($matkhau)){
                    $error_matkhau=" Mật khẩu không được để trống ";
                }elseif (strlen($re_matkhau)){
                    $error_matkhau =" Mật khâu có độ dài hơn 8 ký tự";
                }
            // validate phần re-matkhau
                if(empty($re_matkhau)){
                    $error_re_matkhau = " Nhập lại mật khẩu không được để trống";
                }elseif ($matkhau !== $re_matkhau){
                    $error_re_matkhau = " Mật khẩu nhập lại không trùng khớp";
                }
            }else{
            // kiếm tra xem đã tồn tại hay chưa
                $trung_register = "SELECT * FROM thanhvien WHERE taikhoan ='$taikhoan' ";
                $kq_trung_register = mysqLi_query($ketnoi, $trung_register);

                if(mysqLi_num_rows($kq_trung_register)){
                  echo "<h3 style='color: orange; text-align: center;'>Tài khoản '$taikhoan' đã tồn tại!</h3>"; 

                }else{
                    // tiến hành đưa vào database
                    $save_register= " INSERT INTO thanhvien (id, taikhoan,matkhau)
                                    VALUES ('', '$taikhoan', '$matkhau')";
                    if(mysqLi_query($ketnoi, $save_register)){
                        echo "
                                    <script>
                                     alert('Đăng ký thành công tài khoản: " . $taikhoan . "');
                                    window.location.href = 'login.php'; // Chuyển hướng sang trang login ngay sau khi bấm OK
                                     </script>
                                 ";
    
                            exit(); // Luôn có lệnh exit() sau header để dừng hẳn các mã script phía sau
                    }else {
                        echo "Lỗi hệ thống: " . mysqli_error($ketnoi);
                    }
                }
            }

   

    }

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký</title>
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
            min-height: 100vh;
            padding: 20px 0;
        }

        .register-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333333;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 18px;
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
            border-color: #28a745; /* Đổi sang màu xanh lá đặc trưng của Đăng ký */
        }

        .btn-register {
            width: 100%;
            padding: 12px;
            background: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #218838;
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

    <div class="register-container">
        <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
        
        <form action="register.php" method="POST">

            <!-- <div class="input-group">
                <label for="username">ID</label>
                <input type="text" id="username" name="username" placeholder="Nhập ID muốn đăng ký..." >
            </div> -->
            <div class="input-group">
                <label for="username">Tài khoản</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản muốn đăng ký..." >
                <?php                  
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error_taikhoan . "</h3>";                    
                ?>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." >
                <?php                  
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error_matkhau . "</h3>";                    
                ?>
            </div>

            <div class="input-group">
                <label for="re-password">Nhập lại mật khẩu</label>
                <input type="password" id="re-password" name="re-password" placeholder="Xác nhận lại mật khẩu..." >
            </div>

            <?php 
                 if (!empty($error)) {
                     echo "<h3 style='color: red; text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: 600;'>" . $error . "</h3>";
                     } 
             ?>
            <!-- <div class="input-group">
                <label for="level">Cấp độ (Level)</label>
                <input type="number" id="level" name="lever" value="1" min="1" max="10" placeholder="Nhập level mặc định...">
            </div> -->

            <button type="submit" name="btn-register" class="btn-register">Đăng Ký</button>
        </form>

        <div class="footer-links">
            <p>Đã có tài khoản rồi? <a href="login.php">Đăng nhập ngay</a></p>
        </div>
    </div>

</body>
</html>