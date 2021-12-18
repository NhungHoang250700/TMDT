<?php
include '../db/config.php';
if(isset($_POST['submit'])){
  $hinhanh=$_FILES['hinhanh']['name'];
  $tensanpham=$_POST['tag-name'];
  $dongsanpham=$_POST['product'];
  $donvi=$_POST['tag-unit'];
  $kichthuoc=$_POST['tag-size'];
  $nhacungcap=$_POST['tag-vender'];
  $noidung=$_POST['decriptionproduct'];
  $soluongnhap=$_POST['tag-entered'];
  $soluongban=$_POST['tag-sold'];
  $soluongtrongkho=$_POST['tag-stock'];
  $mucgia=$_POST['tag-price'];
  $trangthai=$_POST['statusPost'];
  $sql_insert_product= mysqli_query($con, "INSERT INTO products(`productImage`, `productName`, `productLineCode`, `Unit`, `Size`, `productVender`, `productDecription`, `quantityEntered`, `quantitySold`, `quantityInStock`, `buyPrice`, `status`) VALUES ('$hinhanh','$tensanpham','$dongsanpham','$donvi','$kichthuoc','$nhacungcap','$noidung','$soluongnhap','$soluongban','$soluongtrongkho','$mucgia','$trangthai')");
  move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/product/'.basename($_FILES["hinhanh"]["name"]));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/content/tables/">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/content/tables/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
    <div class="form-wrap">
        <h2>Thêm bài viết</h2>
        <form  method="POST" action="" enctype="multipart/form-data">
        <div class="form-field">
                <label for="tag-name">Tên sản phẩm</label>
                <input name="tag-name" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
            </div>

            <div class="">
                <label >Hình ảnh</label>
                <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">

            </div>
            
           

            <div class="form-field ">Dòng sản phẩm
            <select name="product" class="form-context">
            <option value='-1'>-----Chọn dòng sản phẩm-----</option>				

                <!--  -->
                <?php
                    $sql_product_post= mysqli_query($con, "SELECT * FROM productlines");
                    while ($row_sanpham = mysqli_fetch_array($sql_product_post)) {

                ?>
                <!--  -->
                <option value="<?php echo $row_sanpham['productLineCode'] ?>" >
                    <!--  -->
                    <?php echo $row_sanpham['productLineName']?>
                    <!--  -->
                </option>
                    <!--  -->
                    <?php
                            }
                    ?>
                    <!--  -->
            </select>
            </div>

            <div class="form-field">
                <label for="tag-unit">Đơn vị</label>
                <input name="tag-unit" class="form-context" id="tag-unit" type="text" value="" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-size">Kích thước</label>
                <input name="tag-size" class="form-context" id="tag-size" type="text" value="" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-vender">Nhà cung cấp</label>
                <input name="tag-vender" class="form-context" id="tag-vender" type="text" value="" size="40" aria-required="true">
            </div>

            <div class="form-field ">
                <label for="decriptionproduct">Mô tả</label>
                <textarea name="decriptionproduct" class="form-context" id="decriptionproduct" rows="10" cols="100%"></textarea>
            </div>
            <div class="form-field">
                <label for="tag-entered">Số lượng nhập vào</label>
                <input name="tag-entered" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
            </div>
            <div class="form-field">
                <label for="tag-sold">Số lượng đã bán</label>
                <input name="tag-sold" class="form-context" id="tag-sold" type="text" value="" size="40" aria-required="true">
            </div>
            <div class="form-field">
                <label for="tag-stock">Số lượng trong kho</label>
                <input name="tag-stock" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-price">Mức giá</label>
                <input name="tag-price" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
            </div>
            <div class="form-field ">Tình trạng
                <select name="statusPost" class="form-context">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Thêm sản phẩm">
            </p>
        </form>
        
       
    </div>


   
 
</body>
</html>

