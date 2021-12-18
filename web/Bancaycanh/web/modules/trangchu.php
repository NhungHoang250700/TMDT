<?php
include '../db/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/trangchu.css" class="css">
  
  <style>
.image-product img{display:block;transition: all .3s ease;}
.image-product img:hover{transform: scale(1.5);}
.image-product p{display:block;overflow: hidden;}

  #slideshow {
  overflow: hidden;
  height: 500px;
  width: 728px;
  margin: 0 auto;
}

.slide-wrapper {
  width: 2912px;
  -webkit-animation: slide 14s ease infinite;
}

.slide {
  float: left;
  height: 510px;
  width: 728px;
}


@-webkit-keyframes slide {
  20% {margin-left: 0px;}
  30% {margin-left: -728px;}
  50% {margin-left: -728px;}
  60% {margin-left: -1456px;}
  80% {margin-left: -1456px;}
}
</style>

</head>
<body>
    <!-- =======BANNER============= -->
    <div class="container">
        <div class="banner">
            <div class="row">
                
                <div class="col-8">
                    <div id="slideshow">
                        <div class="slide-wrapper">
                            <?php
                                $sql_banner= mysqli_query($con, "SELECT * FROM banner WHERE active_banner = 1 LIMIT 3");
                                while ($row_banner = mysqli_fetch_array($sql_banner)) {
                                    ?>
                                <div class="slide"><img src="../admin/image/banner/<?php echo $row_banner['image_banner']?>"></div>
                                <?php
                                }?>  
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapseOne">Danh mục sản phẩm</a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                <?php
                                $sql_pd= mysqli_query($con, "SELECT * FROM productlines");
                                while ($row_pd = mysqli_fetch_array($sql_pd)) {
                                    ?>
                                <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tree-fill" viewBox="0 0 16 16"><path d="M8.416.223a.5.5 0 0 0-.832 0l-3 4.5A.5.5 0 0 0 5 5.5h.098L3.076 8.735A.5.5 0 0 0 3.5 9.5h.191l-1.638 3.276a.5.5 0 0 0 .447.724H7V16h2v-2.5h4.5a.5.5 0 0 0 .447-.724L12.31 9.5h.191a.5.5 0 0 0 .424-.765L10.902 5.5H11a.5.5 0 0 0 .416-.777l-3-4.5z"/></svg>
                                <a href="index.php?web_moc=Danhmucsanpham&id=<?php echo $row_pd['productLineCode']?>" ><?php echo $row_pd['productLineName']?></a>
                                </div>
                                <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="container">
<!-- SẢN PHẨM MỚI -->
    <div class="product_new">
        <div class="pd-new">
            <div class="icon">
            <img src="image/icon1.jpg" alt="Sản phẩm mới"  height="120px">

            </div>
            <div class="title-pd-new">
                <h2><i class="fas fa-briefcase"></i></h2>
                <h2>SẢN PHẨM MỚI</h2>
            </div>
            <div class="row ">
                <?php
                $sql_product_banchay= mysqli_query($con, "SELECT * FROM products A, productlines B WHERE A.productLineCode=B.productLineCode ORDER BY A.productCode DESC LIMIT 9 ");
                while ($row_danhmuc = mysqli_fetch_array($sql_product_banchay)) {
                    ?>
                <div class="col-3">
                    <div class="image-product">
                        <a href="index.php?web_moc=Chitietsanpham&idsp=<?php echo $row_danhmuc['productCode']?>" >
                        <p><img width="255" height="255" src="../admin/image/product/<?php echo $row_danhmuc['productImage']?>" ></p>
                    </div>
                    <div class=" text-center ">
                        <div class="pd-line">	
                        <a class=""> <?php echo $row_danhmuc['productLineName'] ?></a>
                    </div>
                    <div class="pd-name">
                    <a href="index.php?web_moc=Chitietsanpham&idsp=<?php echo $row_danhmuc['productCode']?>"><?php echo $row_danhmuc['productName'] ?></a>
                    </div>
                    <div class="price-wrapper">
                    <span class="price">Giá từ: <span class=""><strong><?php echo $row_danhmuc['buyPrice'] ?><span class="">.000<sup>₫</sup></span></strong></span></span>
                    </div>
                </div>
                <div class="text-center">
                    <button>
                        <a href="index.php?web_moc=Themvaogiohang&idspgh=<?php echo $row_danhmuc['productCode']?>" name="themvaogiohang" data-quantity="1" class="primary is-small mb-0 button product_type_variable add_to_cart_button is-shade" >THÊM VÀO GIỎ HÀNG</a>
                    </button>
                </div>
            </div>
                <?php
                }
                ?>
        </div>
        <div class="addpd">
        <button class="total"><a href="index.php?web_moc=Tatcasanpham">XEM TẤT CẢ</a></buttom>

        </div>

    </div>
          
    <!-- BÀI VIẾT MỚI -->
    <div class="product_new">
        <div class="pd-new">
        <div class="icon">
            <img src="image/icon2.jpg" alt="Sản phẩm mới" height="150px">

            </div>

            <div class="title-pd-new">
                <h2><i class="fas fa-briefcase"></i></h2>
                <h2>BÀI VIẾT MỚI</h2>
            </div>
            <div class="row pd">
                <?php
                $sql_post= mysqli_query($con, "SELECT * FROM newpost LIMIT 3");
                while ($row_post = mysqli_fetch_array($sql_post)) {
                    ?>
                <div class="col-4">
                    <div class="post">
                <div class="image-pt">
                <a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>" >

                    <img width="348" height="350" src="../admin/image/post/<?php echo $row_post['image_post']?>" >
                </a>
                </div>
                <div class="text-pt">
                
                        <p><i class="fa fa-calendar-o"></i><?php echo $row_post['date_post']?></p>
                
                    <h5><a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>"><?php echo $row_post['name_post'] ?></a></h5>
                    <?php echo $row_post['summery_post'] ?>
                </div>
                <div class="read"><a href="index.php?web_moc=Chitietbaiviet&idbv=<?php echo $row_post['id_post']?>">Xem thêm</a></div>
                </div>
                </div>
            
                <?php
                }
                ?>
                </div>
        </div>
    </div>
    <div class="addpd">
    
        <button class="total"><a href="index.php?web_moc=Baiviet">XEM TẤT CẢ</a></buttom>

        </div>
</div>


</body>
</html>
