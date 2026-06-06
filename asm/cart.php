<?php
    // chạy session_start để tạo bộ nhớ tạm
        session_start();
    // gọi file database
        include "connect.php";
    //1. thêm sản phẩm, nhận nút id ở trang danh sách
        if(isset($_GET['mua_id'])){
            $mua = $_GET['mua_id'];

        // tạo giỏ hàng nếu chưa có
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
            }
        // tăng số lượng nếu đã có sản phẩm
            if(isset($_SESSION['cart'][$mua])){
                $_SESSION['cart'][$mua]++;
            }else{
                $_SESSION['cart'][$mua] = 1; // đặt bằng 1 nếu là sản phẩm mới thêm
            }
        // thêm song thfi chuyển hướng về chính nó để làm sạch urlr( mất chữ ?mua_id)
        header("location: cart.php");
        exit();
        }
    // 2. xóa sản phẩm: nhận lệnh từ nút xóa trong giỏ hàng
        if(isset($_GET['action']) && $_GET['action'] == 'delete'){
            $id_xoa = $_GET['id'];
            unset($_SESSION['cart'][$id_xoa]); // gỡ id sản phẩm khỏi bộ nhớ tạm session_start
            header("location:cart.php");
            exit();
        }
    // 3. cập nhật,nhận giữ liệu mảng khi nhấn nút cập nhật giỏ hàng
        if(isset($_POST['btn-update'])){
            if(isset($_POST['quantity'])){
                foreach ($_POST['quantity'] as $id_sp => $so_luong_mua){
                    if($so_luong_mua <= 0){
                        unset($_SESSION['cart'][$id_sp]); // nhập bằng 0 thì coi như xóa
                    }else {
                        $_SESSION['cart'][$id_sp] =  $so_luong_mua; // ghi đề lên số lượng mới
                    }
                }
            }
            header('location: cart.php');
            exit();
        }

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng Của Bạn</title>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .cart-container {
            max-width: 1100px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #212529;
            margin-bottom: 30px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .cart-table th, 
        .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .cart-table th {
            background-color: #f1f3f5;
            font-weight: 600;
            color: #495057;
        }

        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .product-name {
            font-size: 16px;
            color: #212529;
            font-weight: 600;
            text-align: left;
        }

        .price, .subtotal {
            font-weight: 600;
        }
        
        .price { color: #495057; }
        .subtotal { color: #fe3834; }

        .qty-input {
            width: 65px;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            text-align: center;
            font-size: 15px;
            outline: none;
        }

        .qty-input:focus {
            border-color: #228be6;
        }

        .btn-delete {
            color: #ffffff;
            background-color: #fa5252;
            text-decoration: none;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 5px;
            transition: background 0.2s;
            font-size: 13px;
            display: inline-block;
        }

        .btn-delete:hover {
            background-color: #e03131;
        }

        .cart-total-box {
            text-align: right;
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0;
            color: #212529;
        }

        .total-price {
            color: #fe3834;
            font-size: 26px;
            font-weight: 700;
            margin-left: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            border-top: 1px solid #e9ecef;
            padding-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.2s;
        }

        .btn-back {
            background-color: #f1f3f5;
            color: #495057;
            border: 1px solid #dee2e6;
        }

        .btn-back:hover { background-color: #e9ecef; }

        .btn-group-right {
            display: flex;
            gap: 12px;
        }

        .btn-update {
            background-color: #e8f4fd;
            color: #228be6;
            border: 1px solid #74c0fc;
        }

        .btn-update:hover {
            background-color: #228be6;
            color: #ffffff;
        }

        .btn-checkout {
            background-color: #40c057;
            color: #ffffff;
        }

        .btn-checkout:hover { background-color: #37b24d; }

        .empty-cart-box {
            text-align: center;
            padding: 20px 0;
        }
        
        .cart-icon-empty {
            font-size: 64px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>GIỎ HÀNG CỦA BẠN</h2>

    <?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>
        <div class="empty-cart-box">
            <div class="cart-icon-empty">🛒</div>
            <p style="color: #868e96; font-size: 16px; margin-bottom: 25px;">Giỏ hàng của bạn đang trống. Hãy quay lại cửa hàng mua thêm sản phẩm nhé!</p>
            <a href="products.php" class="btn btn-back">Quay lại cửa hàng</a>
        </div>
    <?php else: ?>
       
        <form action="cart.php" method="POST">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th style="width: 120px;">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th style="width: 100px;">Số lượng</th>
                        <th>Thành tiền</th>
                        <th style="width: 100px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_all = 0; // Khởi tạo biến lưu tổng tiền toàn bộ hóa đơn
                    
                    // Lọc bỏ các phần tử lỗi hoặc rỗng trước khi đưa vào SQL IN ()
                    $valid_ids = array_filter(array_keys($_SESSION['cart']));
                    $ids = implode(',', $valid_ids);
                    
                    // Chạy câu lệnh SQL an toàn
                    $sql = "SELECT * FROM sanpham WHERE id IN ($ids)"; 
                    $result = mysqli_query($ketnoi, $sql);

                    // Chạy vòng lặp lấy từng dòng sản phẩm từ MySQL ra bảng HTML
                    while ($result && $row = mysqli_fetch_array($result)) {
                        $id_sp = $row['id'];
                        
                        // Lấy số lượng mua tương ứng của sản phẩm này lưu trong Session
                        $so_luong_mua = $_SESSION['cart'][$id_sp];
                        
                        // Tính toán thành tiền của dòng hiện tại
                        $thanh_tien = $row['gia'] * $so_luong_mua;
                        
                        // Tích lũy cộng dồn vào tổng hóa đơn chung
                        $total_all += $thanh_tien;
                        ?>
                        <tr>
                            <td><strong><?php echo $id_sp; ?></strong></td>
                            
                            <td><img src="<?php echo $row['anh']; ?>" class="product-img" alt="Ảnh"></td>
                            
                            <td class="product-name"><?php echo $row['ten']; ?></td>
                            
                            <td class="price"><?php echo number_format($row['gia'], 0, ',', '.'); ?>đ</td>
                            
                            <td>
                                <input type="number" name="quantity[<?php echo $id_sp; ?>]" value="<?php echo $so_luong_mua; ?>" min="1" class="qty-input">
                            </td>
                            
                            <td class="subtotal"><?php echo number_format($thanh_tien, 0, ',', '.'); ?>đ</td>
                            
                            <td>
                                <a href="cart.php?action=delete&id=<?php echo $id_sp; ?>" class="btn-delete" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <div class="cart-total-box">
                Tổng tiền thanh toán: <span class="total-price"><?php echo number_format($total_all, 0, ',', '.'); ?>đ</span>
            </div>

            <div class="action-buttons">
                <a href="products.php" class="btn btn-back">← Tiếp tục mua hàng</a>
                <div class="btn-group-right">
                    <button type="submit" name="btn-update" class="btn btn-update">Cập nhật số lượng</button>
                    <a href="checkout.php" class="btn btn-checkout">Tiến hành đặt hàng →</a>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>