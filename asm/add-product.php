<?php
        // liên kết với trang connect
    include "connect.php";

    // bắt sự kiện xem nút thêm mới đã hoạt động chưa

        if(isset($_POST['btn-themmoi'])){
            echo " Thành công";

            // tạo ra  4 biến 
            $name=$_POST['ten'];
            $price = $_POST['gia'];
            $image= $_POST['anh'];
            
            $danhmuc = $_POST['danhmuc'];

            // úp dữ liệu lên database
                                                // phần này phải nhìn trong mysql xem mình đặt tên là gì rồi gọi ra( dòng 19)
            $themsanpham = "INSERT INTO sanpham (ten, gia, anh, danhmuc)
                            VALUES ( '$name', '$price', '$image', '$danhmuc')
            ";

            //chạy câu lệnh

            mysqLi_query($ketnoi, $themsanpham);
            
        }

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Mới</title>
    <style>
        /* Toàn bộ cài đặt CSS nằm ở đây */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 600;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #555555;
            margin-bottom: 8px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            font-size: 14px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            outline: none;
            transition: all 0.3s ease;
        }

        /* Hiệu ứng đổi màu viền khi bấm chuột vào ô nhập liệu */
        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #3498db;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #2980b9;
        }

        /* Gợi ý chữ mờ nhỏ bên dưới ô nhập link ảnh */
        .note {
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 5px;
            display: block;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>THÊM SẢN PHẨM</h2>
        
        <form action="add-product.php" method="POST">
            
            <div class="form-group">
                <label for="ten">Tên sản phẩm:</label>
                <input type="text" id="ten" name="ten" placeholder="Ví dụ: Luffy, Nami..." >
            </div>

            <div class="form-group">
                <label for="gia">Giá sản phẩm (VND):</label>
                <input type="number" id="gia" name="gia" min="0" placeholder="Ví dụ: 30000" >
            </div>

            <div class="form-group">
                <label for="anh">Đường dẫn hình ảnh (URL):</label>
                <input type="text" id="anh" name="anh" placeholder="https://i.ibb.co/..." >
                <span class="note">* Điền URL ảnh trực tiếp (Direct link từ ImgBB)</span>
            </div>
           

            <div class="form-group">
                <label for="danhmuc">Danh mục sản phẩm:</label>
                <select id="danhmuc" name="danhmuc" >
                    <option value="">-- Chọn danh mục --</option>
                    <option value="Thời Trang">Thời Trang</option>
                     <option value="Phụ Kiện">Phụ Kiện</option>
                    <option value="Phụ Kiện">Công Nghệ</option>
                     <option value="Phụ Kiện">Gia Dụng</option>
                </select>
            </div>

            <button type="submit"  name ="btn-themmoi" class="btn-submit">Thêm Sản Phẩm Mới</button>

        </form>
    </div>

</body>
</html>