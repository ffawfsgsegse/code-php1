<?php
    // gọi file database connect.php
        include "connect.php";

    // gọi biến edit_id o ở dòng 124 file products.php
        $edit_id = $_GET['edit_id'];
    
    // tạo biến để sửa
        $sua = " SELECT * FROM sanpham WHERE id ='$edit_id' ";
    
    // truy vấn câu lệnh bên trên
       $edit = mysqLi_query($ketnoi, $sua);

    // tạo biến để thực thi câu lệnh trên, Hàm mysqli_fetch_assoc() dịch dữ liệu thô từ biến $edit thành một mảng một chiều (mảng kết hợp) để PHP có thể hiểu và gọi ra dùng được.
        $kq_edit = mysqLi_fetch_assoc($edit);

    // khi nhấn nút edit( lưu sản phẩm)
        if(isset($_POST['btn-edit'])){
            echo " có";
        // tạo ra 4 biến đại diện trong mysql
            $ten = $_POST['product_name'];
            $gia = $_POST['product_price'];
            $anh = $_POST['product_image'];

        // đổ dữ liệu đã sửa vào trong mysql
            $suadulieu = " UPDATE sanpham SET ten='$ten', gia = '$gia', anh ='$anh' WHERE id=".$edit_id ;

            if (mysqLi_query($ketnoi, $suadulieu)){
                echo "
                    <script>
                        alert(` Sửa sản phẩm thành công `);
                        window.location.href = 'products.php'; 
                    </script>
                ";
                // window.location.href = 'products.php'; quay lại trang danh sách khi bấm ok.
            }else {
                echo "
                <script>
                    alert(` sửa thất bại `);
                </script>
                ";
            }


        }else {
            echo " không";
        }






?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sản Phẩm</title>
    
    <style>
        /* Reset CSS cơ bản để giao diện đồng bộ trên các trình duyệt */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        /* Khung bọc toàn bộ form */
        .form-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Tiêu đề của form */
        .form-container h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 25px;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Từng cụm nhập liệu (Label + Input) */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        /* Định dạng chung cho các ô input text, number và select */
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 15px;
            color: #495057;
            transition: border-color 0.15s ease-in-out;
        }

        /* Hiệu ứng khi click vào ô nhập liệu */
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #4dabf7;
            box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.25);
        }

        /* Định dạng riêng cho ô chọn file ảnh */
        .form-group input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px 0;
            font-size: 14px;
            color: #6c757d;
        }

        /* Nút bấm Gửi/Cập nhật */
        .btn-submit {
            background-color: #228be6;
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        /* Hiệu ứng khi di chuột vào nút */
        .btn-submit:hover {
            background-color: #1c7ed6;
        }

        /* Định dạng text thông báo bắt buộc điền (dấu sao đỏ) */
        .required {
            color: #fa5252;
        }
    </style>
</head>
<body>

<div class="form-container">
    
    <h2>Thông Tin Sản Phẩm: <?php echo $kq_edit['ten']; ?></h2> 
    
    <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="product_name">Tên sản phẩm <span class="required">*</span></label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $kq_edit['ten']; ?>" placeholder="Nhập tên sản phẩm..." required>
        </div>

        <div class="form-group">
            <label for="product_price">Giá sản phẩm (VNĐ) <span class="required">*</span></label>
            <input type="number" id="product_price" name="product_price" value="<?php echo $kq_edit['gia']; ?>" placeholder="Nhập giá sản phẩm..." min="0" required>
        </div>

        <div class="form-group">
            <label for="product_image">Hình ảnh sản phẩm</label>
            <div style="margin-bottom: 10px;">
            <img src="<?php echo $kq_edit['anh']; ?>" alt="Ảnh sản phẩm" style="max-width: 100px; border-radius: 4px; display: block;">
            </div>
            <input type="text" id="product_image" name="product_image" value="<?php echo $kq_edit['anh']; ?>" accept="image/*">
        </div>

        <div class="form-group">
            <label for="product_category">Danh mục <span class="required">*</span></label>
            <select id="product_category" name="product_category" required>
                <option value="" disabled selected>-- Chọn danh mục --</option>
                <option value="dien-thoai" <?php echo $kq_edit['danhmuc']; ?> >Thời Trang</option>
                <option value="dien-thoai" <?php echo $kq_edit['danhmuc']; ?> >Điện thoại</option>
                <option value="laptop"  <?php echo $kq_edit['danhmuc']; ?> >Laptop</option>
                <option value="phu-kien"    <?php echo $kq_edit['danhmuc']; ?> >Phụ kiện</option>
                
            </select>
        </div>

        <button type="submit" name="btn-edit" class="btn-submit">Lưu Sản Phẩm</button>
    </form>
</div>

</body>
</html>