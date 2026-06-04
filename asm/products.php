<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Language" content="vi">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sản phẩm - NovaMart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <style>
        .action-bar {
            margin-top: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
        }
        .btn-add-new {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            box-shadow: 0 4px 6px rgba(52, 152, 219, 0.2);
            transition: all 0.3s ease;
        }
        .btn-add-new:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
    </style>
    <style>
      /* Định dạng ô chứa nút chức năng để căn giữa */
table td {
    vertical-align: middle; /* Căn giữa nội dung theo chiều dọc */
    text-align: center;     /* Căn giữa nội dung theo chiều ngang */
}

/* Định dạng nút xóa */
.btn-delete {
    display: inline-block;
    padding: 6px 12px;
    background-color: #e74c3c; /* Màu đỏ */
    color: #ffffff !important;  /* Màu chữ trắng */
    text-decoration: none;     /* Bỏ gạch chân */
    font-size: 13px;
    font-weight: bold;
    border-radius: 4px;
    transition: all 0.2s ease;
}

/* Hiệu ứng khi di chuột vào nút xóa */
.btn-delete:hover {
    background-color: #c0392b; /* Đỏ đậm hơn */
    box-shadow: 0 2px 5px rgba(231, 76, 60, 0.3);
    transform: scale(1.05);    /* Phóng to nhẹ nút */
}
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">NovaMart</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav me-auto"><li class="nav-item"><a class="nav-link" href="index.html">Trang chủ</a></li><li class="nav-item"><a class="nav-link active" href="products.html">Sản phẩm</a></li><li class="nav-item"><a class="nav-link" href="orders.html">Đơn hàng</a></li><li class="nav-item"><a class="nav-link" href="contact.html">Liên hệ</a></li></ul>
        <a class="btn btn-brand position-relative" href="cart.html"><i class="bi bi-bag me-2"></i>Giỏ hàng <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger" data-cart-count>0</span></a>
      </div>
    </div>
  </nav>
  <main class="py-5">
    <div class="container">
      <div class="row g-4">
        <aside class="col-lg-3">

          <!-- bắt đầu form chức năng tìm kiếm -->
          <form method ="POST">
            <div class="table-panel p-3">
              <h1 class="h5 fw-bold">Bộ lọc</h1>
              <label class="form-label mt-3">Tìm kiếm</label>
              <input class="form-control" id="productSearch" name="noidung" placeholder="Tên sản phẩm">
              <button type="submit" name="btn-timkiem"> Tìm Kiếm</button><br>
              <label class="form-label mt-3">Danh mục</label> 
              <select class="form-select" id="categoryFilter"><option>Tất cả</option><option>Thời trang</option><option>Phụ kiện</option><option>Công nghệ</option><option>Gia dụng</option></select>
              <label class="form-label mt-3">Giá tối đa: <span id="priceFilterValue">2.000.000d</span></label>
              <input type="range" class="form-range" id="priceFilter" min="300000" max="2000000" step="50000" value="2000000">
              <a class="btn btn-outline-secondary w-100 mt-2" href="wishlist.html">Sản phẩm yêu thích</a>
            </div>
          </form>
            <?php
                include "connect.php";
                    $noidung="";
                  if(isset($_POST['btn-timkiem'])){
                    // echo " Thành công";
                    $noidung= $_POST['noidung']; // cái này là name của ô nhập 
                    echo $noidung;
                  }
                    // tạo ra 1 biên tự tạo
                  $timkiem = "SELECT * FROM sanpham WHERE ten LIKE '%$noidung%' ";
                  $kq_timkiem = mysqLi_query($ketnoi, $timkiem);

                  // lấy ra các dữ liệu

                  while($search=mysqLi_fetch_array($kq_timkiem)){  //Là hàm có nhiệm vụ "bốc" ra một hàng dữ liệu từ tập hợp
                      ?>
                      <div class="product-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; width: 300px;">
                        <h3 style="margin: 10px 0 5px 0; color: #333;"><?php echo $search['id']; ?></h3>        
                        <img src="<?php echo $search['anh']; ?>" alt="Ảnh sản phẩm" style="max-width: 100%; height: auto; border-radius: 4px;">       
                        <h3 style="margin: 10px 0 5px 0; color: #333;"><?php echo $search['ten']; ?></h3>       
                        <p style="font-size: 14px; color: #777; margin-bottom: 5px;">Danh mục: <?php echo $search['danhmuc']; ?></p>       
                        <p style="color: #fe3834; font-weight: bold;">Giá: <?php echo number_format($search['gia'], 0, ',', '.'); ?> VNĐ</p>
        
                       </div>
                    <?php
                  }
                    ?>

        </aside>
        <section class="col-lg-9">
          <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
            <div><h2 class="h4 fw-bold mb-1">Tất cả sản phẩm</h2><p class="text-muted-2 mb-0" id="productResultText">Đang tải sản phẩm.</p></div>
            <!-- bắt đầu chèn hiển thị từ mysql vào trong trang html ( hay còn gọi là chèn vào trong code cho hiện lên) -->
             <table>
             <thead>
                  <tr>
                      <th>ID</th>
                      <th>-----Tên----</th>
                      <th>----Giá----</th>
                      <th>----Ảnh----</th>
                      <th>----Danh Mục----</th>
                      <th>----Chức Năng----</th>
                  </tr>
              </thead>
            <!-- dùng tbody để hiển thị dữ liệu -->
              <tbody>
                  <?php
                    include "connect.php";
                    $sanpham = "SELECT * FROM sanpham";
                    $kq_sanpham =mysqLi_query($ketnoi, $sanpham);

                    // dùng vòng lặp while để thêm
                      while ($them=mysqLi_fetch_array($kq_sanpham)){
                  ?>
                    <tr>
                      <td><?php echo  $them['id'] ?></td>
                      <td> <?php echo $them['ten'] ?></td>
                      <td><?php echo  $them['gia'] ?></td>
                      <td> <img src="<?php echo  $them['anh'] ?>" width="100px"></td>
                      <td><?php echo  $them['danhmuc'] ?></td>
                      <td>
                        <a href="delete.php?xoa_id=<?php echo $them['id']; ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">Xóa </a>                       
                      </td>
                      <td>
                        <a href="edit.php?edit_id=<?php echo $them['id']; ?>" class="btn-delete" onclick="return confirm('Bạn có muốn sửa không?');">Sửa </a>                       
                      </td>
                      

                    </tr>
                  <?php } ?>
              </tbody>
              </table>
            <select class="form-select w-auto" id="sortFilter"><option value="newest">Sắp xếp mới nhất</option><option value="price-asc">Giá tăng dần</option><option value="price-desc">Giá giảm dần</option><option value="best-seller">Bán chạy</option></select>
          </div>
          <div class="row g-4" id="productGrid"></div>
          <nav class="mt-4"><ul class="pagination"><li class="page-item active"><a class="page-link" href="#">1</a></li><li class="page-item"><a class="page-link" href="#">2</a></li><li class="page-item"><a class="page-link" href="#">3</a></li></ul></nav>
        </section>
      </div>
    </div>
  </main>
  <div class="toast-container position-fixed bottom-0 end-0 p-3"><div id="shopToast" class="toast"><div class="toast-body"></div></div></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/app.js"></script>
  <div class="action-bar">
    <a href="add-product.php" class="btn-add-new">+ Thêm Sản Phẩm Mới</a>
</div>
</body>
</html>