<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/productdetail.css" class="css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
.image-product img{display:block;transition: all .3s ease;}
.image-product img:hover{transform: scale(1.5);}
.image-product p{display:block;overflow: hidden;}
</style>
</head>
<body>
<div class="container">
    <?php
     $sql_product_detail= mysqli_query($con, "SELECT * FROM products A, productlines B WHERE A.productLineCode=B.productLineCode AND A.productCode='$_GET[idsp]' LIMIT 1 ");
     while ($row_productdetail = mysqli_fetch_array($sql_product_detail)) {
         $pdl=$row_productdetail['productLineCode'];
    ?>
    <div class="col-12 my-4 text-uppercase font13 cl_nau" id="breadcrumbs"><span><span>
        <a href="index.php?web_moc=Trangchu">Trang chủ</a> 
        <i class="fa fa-angle-right"></i> 
        <span class="breadcrumb_last" aria-current="page"><?php echo $row_productdetail['productName']?></span></span></span>
    </div>
    
    <div class="row">
        <div class="detail col-12">
        <div class="col-md-5">
            <img class="img-fluid" width="400" height="400" src="../admin/image/product/<?php echo $row_productdetail['productImage']?>" alt="<?php echo $row_productdetail['productName']?>">
        </div>
        <div class="col-md-4">
            <h3 class="my-3"><?php echo $row_productdetail['productName']?></h3>
            <p><?php echo $row_productdetail['buyPrice']?>.000<sup>₫</sup></p>
            <div class="pd-size">Kích thước:<?php echo $row_productdetail['Size']?></div>
            <!-- <form action="index.php?web_moc=Themvaogiohang" method="post">  
            <div class="pd-quantity">Số lượng:<input aria-label="quantity" class="input-qty" max="100" min="1" name="number" type="number" value="1"></div>
            </form> -->
           
            <a href="index.php?web_moc=Themvaogiohang&idspgh=<?php echo $row_productdetail['productCode']?>" class="btn btn-success btn-block">GIỎ HÀNG</a>

        </div>
        </div>
    </div>
    <!-- MO TA -->
    <div class="contex">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home"> MÔ TẢ</a></li>
        </ul>
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
            <?php echo $row_productdetail['productDecription']?>
            </div>
            
        </div>
    </div>
    <!-- BAI VIET -->
    <div class="product_new">
        <div class="pd-new">
            <div class="title-pd-new">
                <h3>SẢN PHẨM TƯƠNG TỰ</h3>
                <a class="dropdown-item" href="index.php?web_moc=Danhmucsanpham&id=<?php echo $pdl?>">Xem thêm</a>
            </div>
            <div class="row ">
                
                <?php
                $sql_product_banchay= mysqli_query($con, "SELECT * FROM products A, productlines B WHERE A.productLineCode=B.productLineCode AND A.productLineCode='$pdl' AND A.productCode not like '$_GET[idsp]' ORDER BY A.productCode DESC LIMIT 4 ");
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
                        <a href="index.php?web_moc=Themvaogiohang&idspgh=<?php echo $row_danhmuc['productCode']?>" name="themvaogiohang" data-quantity="1"  >THÊM VÀO GIỎ HÀNG</a>
                    </button>
                </div>
            
               
            </div>
            <?php
                }
                ?>
        </div>
    </div>

    <!-- ==========SAN PHAM KHAC====== -->
    <div class="product_new">
        <div class="pd-new">
            
            <div class="title-pd-new">
                <h3>SẢN PHẨM KHÁC</h3>
                <a class="dropdown-item" href="index.php?web_moc=Tatcasanpham&idsp=<?php echo !$pdl?>">Xem thêm</a>
            </div>
            <div class="row ">
                <?php
                $sql_product_banchay= mysqli_query($con, "SELECT * FROM products A, productlines B WHERE A.productLineCode=B.productLineCode AND A.productLineCode not like '$pdl' LIMIT 4 ");
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
                    <a href="index.php?web_moc=Themvaogiohang&idspgh=<?php echo $row_danhmuc['productCode']?>" data-quantity="1" >THÊM VÀO GIỎ HÀNG</a>
                    </button>
                </div>
               
            </div>
            <?php
                }
                ?>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</div>

</body>
</html>




