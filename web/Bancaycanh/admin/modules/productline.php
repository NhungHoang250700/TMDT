<?php
include '../db/config.php';
//Thêm
if(isset($_POST['submit'])){
    $idproductline=$_POST['productLineCode'];
    $tenproductline=$_POST['tag-name'];
    $mota=$_POST['productLineDecription'];
    $hinhanh=$_FILES['hinhanh']['name'];
    $sql_insert_category= mysqli_query($con, "INSERT INTO productlines( productLineCode,`productLineName`, `productLineImage`, `productLineDecription`) VALUES ('$idproductline','$tenproductline','$hinhanh','$mota')");
    move_uploaded_file($_FILES["hinhanh"]["tmp_name"],'image/productline/'.basename($_FILES["hinhanh"]["name"]));
  
  }
  //Sửa
  elseif(isset($_POST['submitud'])){
    $idproductline=$_POST['productLineCode'];
    $tenproductline=$_POST['tag-name'];
    $mota=$_POST['productLineDecription'];
    $hinhanh=$_FILES['hinhanh']['name'];
    if($hinhanh==''){
        $sql_update_image = "UPDATE productlines SET productLineCode='$idproductline', productLineName='$tenproductline',productLineDecription='$mota' WHERE productLineCode='$idproductline'";
    }else{
      move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/productline/'.basename($_FILES["hinhanh"]["name"]));
      $sql_update_image = "UPDATE productlines SET productLineCode='$idproductline', productLineName='$tenproductline',productLineImage='$hinhanh',productLineDecription='$mota' WHERE productLineCode='$idproductline'";
    }
    mysqli_query($con,$sql_update_image);
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM productlines WHERE productLineCode='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/productline.css"></link>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <h5>category</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row">
            <?php
            if(isset($_GET['quanly'])=='capnhap'){
                $idupdate=$_GET['idpd'];
                $sql_update_productline=mysqli_query($con, "SELECT * FROM productlines WHERE productLineCode='$idupdate'");
                $row_update_productline=mysqli_fetch_array($sql_update_productline);
                ?>
                <div class="col-4">
                    <form  method="POST" action="" enctype="multipart/form-data">
                    <div class="form-field">
                            <label for="productLineCode">Mã</label>
                            <input name="productLineCode" class="form-context" id="productLineCode" type="text" value="<?php echo $row_update_productline['productLineCode']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_productline['productLineName']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label >Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                            <img  class="img-thumbnail" src="image/productline/<?php echo $row_update_productline['productLineImage']?>" width="20%" height="20%">

                        </div>
                        <div class="form-field ">
                            <label for="productLineDecription">Mô tả</label>
                            <textarea name="productLineDecription" class="form-context" id="productLineDecription" rows="5" cols="50%"><?php echo $row_update_productline['productLineDecription']?></textarea>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submitud" id="submit" class="btn btn-primary" value="Chỉnh sửa Chuyên mục">	<span class="spinner"></span>
                        </p>
                    </form>
                </div>

            <?php
            }else{
                ?>
                <div class="col-4">
                    <form  method="POST" action="" enctype="multipart/form-data">
                        <div class="form-field">
                            <label for="productLineCode">Mã</label>
                            <input name="productLineCode" data-success="right" type="text" class="form-control" required="required" value="" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label>Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                        </div>
                        
                        <div class="form-field ">
                            <label for="productLineDecription">Mô tả</label>
                            <textarea name="productLineDecription" class="form-context" id="productLineDecription" rows="5" cols="50%" placeholder="Không vượt quá ( ~ 200 ký tự )"></textarea>
                        </div>
                                    
                        <p class="submit">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Thêm">	<span class="spinner"></span>
                        </p>
                    </form>
                </div>

                <?php
            }
                ?>

                <!-- ===================Search======================= -->
                <div class="col-8">

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_productline_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_productline_page;
                    $sql_select_productline = mysqli_query($con,"SELECT * FROM productlines WHERE productLineName like '%$tukhoa%' ORDER BY productLineCode DESC LIMIT $sum_productline_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM productlines WHERE productLineName like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_productline_page);
                    ?>
                    <h5>Danh sách category</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">Mã</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Mô tả</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_productline = mysqli_fetch_array($sql_select_productline)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $row_productline['productLineCode']?></td>
                            <td>
                            <img class="img-thumbnail" src="image/productline/<?php echo $row_productline['productLineImage'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_productline['productLineName']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_productline['productLineDecription']?></td>
                        
                            <td>

                            <a href="?admin_moc=Danhmuc&quanly==capnhap&idpd=<?php echo $row_productline['productLineCode'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Danhmuc&xoa=<?php echo $row_productline['productLineCode']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    <h5>Danh sách dong san pham</h5>
                <?php
                    $sum_productline_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_productline_page;
                    $sql_select_productline = mysqli_query($con,"SELECT * FROM productlines ORDER BY productLineCode DESC LIMIT $sum_productline_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM productlines");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_productline_page);

                    ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Mô tả</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_productline = mysqli_fetch_array($sql_select_productline)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $row_productline['productLineCode']?></td>
                            <td>
                            <img class="img-thumbnail" src="image/productline/<?php echo $row_productline['productLineImage'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_productline['productLineName']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_productline['productLineDecription']?></td>
                        
                            <td>
                            <a href="?admin_moc=Danhmuc&quanly==capnhap&idpd=<?php echo $row_productline['productLineCode'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Danhmuc&xoa=<?php echo $row_productline['productLineCode']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Danhmuc&per-page=<?php echo $sum_productline_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Danhmuc&per-page=<?php echo $sum_productline_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Danhmuc&per-page=<?php echo $sum_productline_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Danhmuc&per-page=<?php echo $sum_productline_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Danhmuc&per-page=<?php echo $sum_productline_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
                                    </li>
                                    <?php
                                    }
                                    ?>
                    </ul>
                </nav>
            </div>
        </div>
        
    </div>
    
</body>
</html>