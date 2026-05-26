<?php
// Bắt đầu session để kiểm tra xem có lỗi nào từ file xử lý gửi về không
session_start();

// Nếu đã đăng nhập trước đó rồi thì tự động vào thẳng trang quản trị
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

// Lấy thông báo lỗi và tên tài khoản cũ nhập sai (nếu có) từ session sang biến tạm
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old_username = isset($_SESSION['old_username']) ? $_SESSION['old_username'] : '';

// Sau khi lấy xong thì XÓA NGAY lỗi trong session để khi bấm F5 tải lại trang lỗi sẽ biến mất
unset($_SESSION['errors']);
unset($_SESSION['old_username']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }
        .login-container {
            background: #fff; padding: 30px 40px; border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2); width: 100%; max-width: 400px;
        }
        .login-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
        
        /* Box hiển thị lỗi */
        .error-box {
            background-color: #fce4e4; border: 1px solid #fcc2c3;
            border-radius: 5px; padding: 10px 15px; margin-bottom: 20px;
            color: #cc0000; font-size: 14px;
        }
        .error-box ul { padding-left: 20px; }

        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; margin-bottom: 8px; color: #666; font-size: 14px; }
        .input-group input {
            width: 100%; padding: 12px; border: 1px solid #ccc;
            border-radius: 5px; font-size: 16px; transition: all 0.3s ease;
        }
        .input-group input:focus {
            border-color: #9b59b6; outline: none; box-shadow: 0 0 8px rgba(155, 89, 182, 0.2);
        }
        .options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 14px; }
        .options a { color: #9b59b6; text-decoration: none; }
        .options a:hover { text-decoration: underline; }
        .btn-login {
            width: 100%; padding: 12px; background: linear-gradient(135deg, #71b7e6, #9b59b6);
            border: none; border-radius: 5px; color: #fff; font-size: 16px; font-weight: bold;
            cursor: pointer; transition: opacity 0.3s ease;
        }
        .btn-login:hover { opacity: 0.9; }
        .signup-link { text-align: center; margin-top: 20px; font-size: 14px; color: #666; }
        .signup-link a { color: #9b59b6; text-decoration: none; font-weight: bold; }
        .signup-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Đăng Nhập</h2>

        <?php if (!empty($errors)): ?>
            <div class="error-box">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="lab1-dn.php" method="POST">
            <div class="input-group">
                <label for="username">Tên tài khoản hoặc Email</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản của bạn" value="<?php echo htmlspecialchars($old_username); ?>">
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <div class="options">
                <label>
                    <input type="checkbox" name="remember"> Ghi nhớ tôi
                </label>
                <a href="#">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="btn-login">Đăng Nhập</button>

            <div class="signup-link">
                Chưa có tài khoản? <a href="#">Đăng ký ngay</a>
            </div>
        </form>
    </div>

</body>
</html>