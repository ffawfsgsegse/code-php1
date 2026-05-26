<?php
// Bắt đầu session để có thể quăng ngược lỗi về lại trang đăng nhập
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    $errors = [];

    // 1. Validate Tài khoản
    if (empty($username)) {
        $errors[] = "Tài khoản không được để trống.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Tài khoản phải từ 3 ký tự trở lên.";
    }

    // 2. Validate Mật khẩu
    if (empty($password)) {
        $errors[] = "Mật khẩu không được để trống.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Mật khẩu phải từ 6 ký tự trở lên.";
    }

    // 3. Nếu không dính lỗi trống/ngắn, tiến hành check tài khoản đúng hay sai
    if (empty($errors)) {
        $valid_username = "admin";
        $valid_password = "123456";

        if ($username === $valid_username && $password === $valid_password) {
            // ĐĂNG NHẬP THÀNH CÔNG: Tạo session đăng nhập và đá sang dashboard
            $_SESSION['user'] = $username;
            $_SESSION['is_logged_in'] = true;
            
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    }

    // 4. XỬ LÝ LỖI (Nếu có lỗi bất kì xảy ra)
    if (!empty($errors)) {
        // Ném mảng lỗi và tên tài khoản cũ vào Session để trang giao diện bốc ra hiển thị
        $_SESSION['errors'] = $errors;
        $_SESSION['old_username'] = $username;
        
        // Quay trở về trang giao diện đăng nhập
        header("Location: lab1.php");
        exit();
    }

} else {
    // Nếu ai đó cố tình vào thẳng link file process này, đuổi về trang đăng nhập luôn
    header("Location: index.php");
    exit();
}
?>