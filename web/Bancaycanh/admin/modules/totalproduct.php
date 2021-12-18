<?php
include '../db/config.php';
  //Sửa
  if(isset($_POST['submitud'])){
    $idproduct=$_POST['tag-id'];
    $tenproduct=$_POST['tag-name'];
    $dongsanpham=$_POST['product'];
    $donvi=$_POST['tag-unit'];
    $kichthuoc=$_POST['tag-size'];
    $nhacungcap=$_POST['tag-vender'];
    $noidung=$_POST['decriptionproduct'];
    $soluongnhap=$_POST['tag-entered'];
    $soluongban=$_POST['tag-sold'];
    $soluongtrongkho=$_POST['tag-stock'];
    $mucgia=$_POST['tag-price'];
      $trangthai=$_POST['statusproduct'];
    $hinhanh=$_FILES['hinhanh']['name'];
    if($hinhanh==''){
        $sql_update_image = "UPDATE products SET productName='$tenproduct',productLineCode='$dongsanpham',Unit='$donvi',Size='$kichthuoc',productVender='$nhacungcap',productDecription='$noidung',quantityEntered='$soluongnhap',quantitySold='$soluongban',quantityInStock='$soluongtrongkho',buyPrice='$mucgia', status='$trangthai' WHERE productCode='$idproduct'";
    }else{
      move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/product/'.basename($_FILES["hinhanh"]["name"]));
      $sql_update_image = "UPDATE products SET productName='$tenproduct',productImage='$hinhanh',productLineCode='$dongsanpham',Unit='$donvi',Size='$kichthuoc',productVender='$nhacungcap',productDecription='$noidung',quantityEntered='$soluongnhap',quantitySold='$soluongban',quantityInStock='$soluongtrongkho',buyPrice='$mucgia', status='$trangthai' WHERE productCode='$idproduct'";
    }
    mysqli_query($con,$sql_update_image);
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM products WHERE productCode='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/totalproduct.css"></link>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <h5>Tất cả bài viết</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row">
            <?php
            if(isset($_GET['quanly'])=='capnhap'){
                $idupdate=$_GET['idpd'];
                $sql_update_product=mysqli_query($con, "SELECT * FROM products WHERE productCode='$idupdate'");
                $row_update_product=mysqli_fetch_array($sql_update_product);
                $productCode_update=$row_update_product['productLineCode'];

                ?>
                    <form  method="POST" action="" enctype="multipart/form-data">
                    
                            <input name="tag-id" class="form-context " type="hidden" id="tag-id" type="text" value="<?php echo $row_update_product['productCode']?>" size="40" aria-required="true">
                            
                        <div class="form-field">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_product['productName']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label >Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                            <img  class="img-thumbnail" src="image/product/<?php echo $row_update_product['productImage']?>" width="20%" height="20%">

                        </div>
                        
                        <div class="form-field ">Danh mục sản phẩm
                            <select name="product" class="form-context">
                                <option value='-1'disabled>-----Chọn dòng sản phẩm-----</option>				
                                <?php
                                    $sql_productline_product= mysqli_query($con, "SELECT * FROM productlines ORDER BY productLineCode DESC");
                                    while ($row_productline = mysqli_fetch_array($sql_productline_product)) {
                                        if($productCode_update==$row_productline['productLineCode']){

                                ?>
                                <option selected value="<?php echo $row_productline['productLineCode'] ?>" >
                                    <?php echo $row_productline['productLineName']?>
                                </option>
                                <?php
                                } else{
                                ?>
                                <option value="<?php echo $row_productline['productLineCode'] ?>" >
                                    <?php echo $row_productline['productLineName']?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                                </select>
                            </div>

                            
            <div class="form-field">
                <label for="tag-unit">Đơn vị</label>
                <input name="tag-unit" class="form-context" id="tag-unit" type="text" value="<?php echo $row_update_product['Unit']?>" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-size">Kích thước</label>
                <input name="tag-size" class="form-context" id="tag-size" type="text" value="<?php echo $row_update_product['Size']?>" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-vender">Nhà cung cấp</label>
                <input name="tag-vender" class="form-context" id="tag-vender" type="text" value="<?php echo $row_update_product['productLineCode']?>" size="40" aria-required="true">
            </div>

            <div class="form-field ">
                <label for="decriptionproduct">Mô tả</label>
                <textarea name="decriptionproduct" class="form-context"  id="decriptionproduct" rows="10" cols="100%"><?php echo $row_update_product['productDecription']?></textarea>
            </div>
            <div class="form-field">
                <label for="tag-entered">Số lượng nhập vào</label>
                <input name="tag-entered" class="form-context" id="tag-entered" type="text" value="<?php echo $row_update_product['quantityEntered']?>" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-sold">Số lượng đã bán</label>
                <input name="tag-sold" class="form-context" id="tag-sold" type="text" value="<?php echo $row_update_product['quantitySold']?>" size="40" aria-required="true">
            </div>
            <div class="form-field">
                <label for="tag-stock">Số lượng trong kho</label>
                <input name="tag-stock" class="form-context" id="tag-stock" type="text" value="<?php echo $row_update_product['quantityInStock']?>" size="40" aria-required="true">
            </div>

            <div class="form-field">
                <label for="tag-price">Mức giá</label>
                <input name="tag-price" class="form-context" id="tag-price" type="text" value="<?php echo $row_update_product['buyPrice']?>" size="40" aria-required="true">
            </div>

                                    
                        <div class="form-field ">Tình trạng
                            <select name="statusproduct" class="form-context">
                            <?php
                            if($row_update_product['status_display_post']==1){ 
                                ?>
                                <option value="1" selected>Kích hoạt</option>
                                <option value="0">Ẩn</option>
                                <?php
                                }else{ 
                                    ?>
                                    <option value="1">Kích hoạt</option>
                                    <option value="0" selected>Ẩn</option>
                                    <?php
                                    } 
                                    ?>
                            </select>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submitud" id="submit" class="btn btn-primary" value="Chỉnh sửa">	<span class="spinner"></span>
                            <a href="index_admin.php?admin_moc=Tatcasanpham" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>

                        </p>
                    </form>
              

            <?php
            }
                ?>

                <!-- ===================Search======================= -->

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_product_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_product_page;
                    $sql_select_product = mysqli_query($con,"SELECT A.*, B.* FROM products A, productlines B WHERE A.productLineCode=B.productLineCode AND A.productName like '%$tukhoa%' ORDER BY productCode DESC LIMIT $sum_product_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM products WHERE productName like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_product_page);
                    ?>
                <table class="table table-bordered table-hover">

<thead>
    <tr>
        <th><input id="check_all" type="checkbox"></th>
        <th>Mã</th>
        <th>Hình ảnh</th>
        <th>Tên</th>
        <th>Dòng sản phẩm</th>
        <th>Giá</th>
        <th>Đơn vị</th>
        <th>Kích thước</th>
        <th>Số lượng</th>
        <th>Nhà cung cấp</th>
        <th>Tình trạng</th>


    </tr>
</thead>
<?php
$i = 0;
while($row_product = mysqli_fetch_array($sql_select_product)){
    $i++;
    ?>
<tbody>
    <tr>
        <td>
        <input name="id[]" type="checkbox" value="1">
        </td>
        <td class="hidden-sm hidden-xs"><?php echo $i?></td>
        <td>
        <img class="img-thumbnail" src="image/product/<?php echo $row_product['productImage'] ?>" alt="" width="100px">
        </td>
        <td class="hidden-sm hidden-xs"><?php echo $row_product['productName']?></td>
        <td class="hidden-sm hidden-xs"><?php echo $row_product['productLineName']?></td>
        <td class="hidden-sm hidden-xs"><?php echo $row_product['buyPrice']?></td>

        <td class="hidden-sm hidden-xs"><?php echo $row_product['Unit']?></td>

        <td class="hidden-sm hidden-xs"><?php echo $row_product['Size']?></td>
        <td class="hidden-sm hidden-xs"><?php echo $row_product['quantityInStock']?></td>
        <td class="hidden-sm hidden-xs"><?php echo $row_product['productVender']?></td>
       
        <td>
            <?php if(($row_product['status'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
        </td>
        <td>

        <a href="?admin_moc=Tatcasanpham&quanly==capnhap&idpd=<?php echo $row_product['productCode'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
        <a href="?admin_moc=Tatcasanpham&xoa=<?php echo $row_product['productCode']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
        </td>
    </tr>
    
</tbody>
<?php
}
?>
</table>

                    <?php
                }else{
                    ?>
                <?php
                    $sum_product_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_product_page;
                    $sql_select_product = mysqli_query($con,"SELECT A.*, B.* FROM products A, productlines B WHERE A.productLineCode=B.productLineCode ORDER BY productCode DESC LIMIT $sum_product_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM products");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_product_page);

                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th>Mã</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Dòng sản phẩm</th>
                            <th>Giá</th>
                            <th>Đơn vị</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Nhà cung cấp</th>
                            <th>Tình trạng</th>


                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_product = mysqli_fetch_array($sql_select_product)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/product/<?php echo $row_product['productImage'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_product['productName']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_product['productLineName']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_product['buyPrice']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_product['Unit']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_product['Size']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_product['quantityInStock']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_product['productVender']?></td>
                           
                            <td>
                                <?php if(($row_product['status'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
                            </td>
                            <td>

                            <a href="?admin_moc=Tatcasanpham&quanly==capnhap&idpd=<?php echo $row_product['productCode'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Tatcasanpham&xoa=<?php echo $row_product['productCode']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
                            </td>
                        </tr>
                        
                    </tbody>
                    <?php
                    }
                    ?>
                </table>

                    <?php
                }
                    ?>

                
                
                <!-- ======================Pagination=================== -->
                <nav aria-label="..." class ="pagina-button">
                    <ul class="pagination">
                        <?php
                        if($current_page > 2){
                            $fist_page=1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Tatcasanpham&per-page=<?php echo $sum_product_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Tatcasanpham&per-page=<?php echo $sum_product_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Tatcasanpham&per-page=<?php echo $sum_product_page?>&page=<?php echo $num?>"><?php echo $num?></a>
                                </li>
                                <?php
                                }  
                            }else{
                                ?>
                                <li class="page-item active">
                                    <a class="page-link"><?php echo $num?></a>
                                </li>
                                <?php
                                }
                            }
                            ?>
                            <?php
                            if($current_page < $totalPages - 1){
                                $next_page=$current_page+1;
                                ?>
                                <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Tatcasanpham&per-page=<?php echo $sum_product_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Tatcasanpham&per-page=<?php echo $sum_product_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
                                    </li>
                                    <?php
                                    }
                                    ?>
                    </ul>
                </nav>
            </div>
        </div>
        
    </div>
 </div>
    
</body>
</html>