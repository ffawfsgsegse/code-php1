<?php
<<<<<<< HEAD

    include "connectt.php";

   





    // . bắt sự kiện khi nhấn nút đăng ký

        if(isset($_POST['btn-register'])){  // bắt sự kiện ở "name" phần có nút đăng ký
            echo " Thành công";

             //1. validate form đăng ký
        // loại bỏ khoảng trắng thừa mà người dùng vô tình gõ ở đầu hoặc cuối chuỗi.
            $taikhoan = trim($_POST['username']);
            $matkhau = trim($_POST['password']);
            $nhaplaimatkhau = trim($_POST['re-password']);
            $lever = trim($_POST['lever']);

            $error =""; // biến dùng để chữa lỗi

    
        // kiểm tra điều kiện để đăng ký cơ bản
            if(empty($taikhoan)|| empty($matkhau)||empty($nhaplaimatkhau)){
                $error= " vui lòng điền đầy đủ các thông tin trên";
            }
            if (strlen($taikhoan) < 8){
                $error= " Tài khoản độ dài phải lớn hơn 8";
            }
            if (strlen($matkhau) < 8){
                $error= " Mật khẩu độ dài phải lớn hơn 8";
            }
            if ($matkhau !== $nhaplaimatkhau){
                $error= " Mật khẩu nhập không trùng khớp";
            }
        // in lỗi ra màn hình
            if(!empty($error)){
                echo "<h3 style='color: red; text-align: center;'>" . $error . "</h3>";
            }else {
                // kiểm tra xem tài khoản tồn tại trong database hay chưa
                    $trung_register = "SELECT * FROM thanhvien WHERE taikhoan='$taikhoan'";
                    $kq_trung_register = mysqLi_query($ketnoi, $trung_register);

                    if (mysqLi_num_rows($kq_trung_register)){
                        echo "<h3 style='color: orange; text-align: center;'>Tài khoản '$taikhoan' đã tồn tại!</h3>";
                    }else {
                        // tiến hành đưa dữ liệu vào database
                        $save_register =  "INSERT INTO thanhvien (id, taikhoan, matkhau, lever)  
                                  VALUES ('', '$taikhoan', '$matkhau', '$lever')";
                        
                        if (mysqLi_query($ketnoi, $save_register)){
                            
                            // echo "<h3 style='color: green; text-align: center;'>Đăng ký thành công tài khoản: $taikhoan</h3>";
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

        



            // tạo biến như ở trong mysql
                // $id="";
                // $taikhoan= $_POST['username'];  // lấy ở "name" 
                // $matkhau = $_POST['password'];
                // $lever=2;

            // đưa dữ liệu lên database

                // $save_register = "INSERT INTO  thanhvien (id, taikhoan, matkhau, lever)  
                // VALUES ('$id', '$taikhoan', '$matkhau', '$lever');
                // ";
                // // cho hàm bên trên chạy

                // mysqLi_query($ketnoi, $save_register);
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
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." >
            </div>

            <div class="input-group">
                <label for="re-password">Nhập lại mật khẩu</label>
                <input type="password" id="re-password" name="re-password" placeholder="Xác nhận lại mật khẩu..." >
            </div>

            <div class="input-group">
                <label for="level">Cấp độ (Level)</label>
                <input type="number" id="level" name="lever" value="1" min="1" max="10" placeholder="Nhập level mặc định...">
            </div>

            <button type="submit" name="btn-register" class="btn-register">Đăng Ký</button>
        </form>

        <div class="footer-links">
            <p>Đã có tài khoản rồi? <a href="login.php">Đăng nhập ngay</a></p>
        </div>
    </div>

</body>
</html>
=======
// require_once './ql_user.php';
    include "user.php";
    include "db_utils.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])
   && isset($_POST["username"]) && 
  isset($_POST["password"])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $isError = false;
  if (empty($username) || empty($password) || empty($name)) {
    echo "khong duoc de trong";
    $isError = true;
  }
  if (strlen($password) < 6) {
    echo "Mat khau ko dc be hon 6 ky tu";
    $isError = true;
  }
  if(!$isError) {
    /**
     * tao moi 1 user
      */
    // $qlUsers = new QLUser();
    // $userDangKy = new User($name, $username, $password);
    // $ketqua = $qlUsers->insert($userDangKy);

    $sql_checkuser = "select * from users where username = ?";
    $db_utils = new DB_UTILS();
    $result = $db_utils ->getAll($sql_checkuser, [$username]);
  }
} else {
  echo "loi";
}
?>

<!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="vi">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng ký - NovaMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body class="section-band">
  <main class="container py-5">
    <div class="auth-panel p-4 p-md-5 mx-auto" style="max-width:520px">
      <a class="navbar-brand fw-bold" href="index.html">NovaMart</a>
      <h1 class="h3 fw-bold mt-4">Tạo tài khoản</h1>
      <form method="POST" class="mt-3" action="">
        <label class="form-label">Họ tên</label><input type="text" name="name" class="form-control mb-3">
        <label class="form-label">Tai khoan</label><input class="form-control mb-3" name="username">
        <label class="form-label">Mật khẩu</label><input class="form-control" type="password" mb-3 name="password">
        <button type="submit" class="btn btn-brand w-100">Đăng ký</button>
      </form>
      <p class="mt-3 mb-0">Đã có tài khoản? <a href="login.html">Đăng nhập</a></p>
    </div>
  </main>
</body>

</html>
>>>>>>> 6c1df1bfb9dc3bc6bc7c5dea306a38f0b99f5306
