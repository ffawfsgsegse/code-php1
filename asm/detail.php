<?php
    // gọi session_start
      session_start();
    // gọi database
      include "connect.php";
    // kiểm tra lấy dữ liệu detail-id
      if(isset($_GET['detail_id'])){
        $detail = $_GET['detail_id'];

        // lấy sản phẩm có id bằng với id nhận từ url
          $chitiet = " SELECT * FROM sanpham WHERE id = '$detail' ";
          $kq_chitiet = mysqLi_query($ketnoi, $chitiet);
        // bốc dòng dữ liệu đó ra, tạo biến mới
          $ketqua = mysqLi_fetch_array($kq_chitiet);
        // không có sản phẩm ( tránh trường hợp người dùng nhập đại id trê url)
          if(!$ketqua){
            echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='products.php';</script>";
            exit();
          }
      }else {
        // Nếu vào thẳng trang detail.php mà không bấm từ trang danh sách (không có ?id=...) -> Đẩy về trang danh sách
          header("Location: products.php");
          exit();
      }
    // thêm vào giỏ hàng , ngay ở trang chi tiết sản phẩm
      if(isset($_GET['action']) && $_GET['action'] == 'add'){
        $mua = $_GET['id'];
        if(!isset($_SESSION['cart'])){
          $_SESSION['cart'] = array();
        }
        if(isset($_SESSION['cart'][$mua])){
          $_SESSION['cart'][$mua]++;
        }else{
          $_SESSION['cart'][$mua] = 1;
        }
        // mua song đẩy người dùng qua trang giỏ hàng kiểm tra
        header("location: cart.php");
        exit();
      }

?>

<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="vi">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chi tiết sản phẩm - NovaMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <style>
      /* Thêm chút CSS để trang trí khối chi tiết sản phẩm cho đẹp mắt */
      .product-detail-box { background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
      .product-img { max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #e9ecef; }
      .price-style { font-size: 28px; color: #fe3834; font-weight: 700; margin: 15px 0; }
      .btn-buy-now { background-color: #228be6; color: #ffffff !important; padding: 12px 28px; font-weight: 600; border-radius: 6px; text-decoration: none; display: inline-block; transition: all 0.2s; border: none; }
      .btn-buy-now:hover { background-color: #1c7ed6; box-shadow: 0 4px 12px rgba(34,139,230,0.3); }
      .btn-back { background-color: #f1f3f5; color: #495057 !important; border: 1px solid #dee2e6; padding: 12px 24px; font-weight: 600; border-radius: 6px; text-decoration: none; display: inline-block; }
      .btn-back:hover { background-color: #e9ecef; }
  </style>
</head>
<body>
  <nav class="navbar bg-white border-bottom">
      <div class="container">
          <a class="navbar-brand fw-bold" href="products.php">NovaMart</a>
          <a class="btn btn-brand position-relative" href="cart.php">
              <i class="bi bi-bag me-2"></i>Giỏ hàng 
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger" data-cart-count>
                  <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
              </span>
          </a>
      </div>
  </nav>

  <main class="py-5">
    <div class="container" id="productDetail">
        <div class="product-detail-box">
            <div class="row g-5">
                
                <div class="col-md-5 text-center">
                    <img src="<?php echo $ketqua['anh']; ?>" class="product-img" alt="Ảnh sản phẩm">
                </div>
                
                <div class="col-md-7 d-flex flex-column justify-content-center">
                    
                    <div class="text-muted mb-2" style="font-size: 14px;">
                        <span>Mã: <strong>#<?php echo $ketqua['id']; ?></strong></span>
                        <span class="ms-4">Danh mục: <strong><?php echo $ketqua['danhmuc']; ?></strong></span>
                    </div>
                    
                    <h1 class="fw-bold h2 text-dark mb-2"><?php echo $ketqua['ten']; ?></h1>
                    
                    <div class="price-style">
                        <?php echo number_format($ketqua['gia'], 0, ',', '.'); ?> VNĐ
                    </div>
                    
                    <hr class="my-4">
                    
                    <h5 class="fw-bold mb-2">Mô tả sản phẩm:</h5>
                    <p class="text-muted mb-4" style="line-height: 1.6;">
                        Sản phẩm cao cấp được phân phối chính hãng bởi hệ thống siêu thị <strong>NovaMart</strong>. Đảm bảo đạt tiêu chuẩn kiểm định khắt khe, cam kết chất lượng hàng đầu và an toàn tuyệt đối cho người sử dụng. Chính sách hỗ trợ đổi trả linh hoạt trong vòng 7 ngày nếu xuất hiện lỗi kỹ thuật từ nhà sản xuất.
                    </p>
                    
                    <div class="d-flex gap-3">
                        <a href="products.php" class="btn-back">← Quay lại cửa hàng</a>
                        
                        <a href="detail.php?action=add&detail_id=<?php echo $ketqua['id']; ?>" class="btn-buy-now">
                            <i class="bi bi-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </main>

  <div class="toast-container position-fixed bottom-0 end-0 p-3"><div id="shopToast" class="toast"><div class="toast-body"></div></div></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/app.js"></script>
  
</body>
</html>




