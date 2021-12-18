<?php
include '../db/config.php';
//Thêm
if(isset($_POST['submit'])){
    $tencategory=$_POST['tag-name'];
    $mota=$_POST['description'];
    $hinhanh=$_FILES['hinhanh']['name'];
    $sql_insert_category= mysqli_query($con, "INSERT INTO category( `name_category`, `image_category`, `description`) VALUES ('$tencategory','$hinhanh','$mota')");
    move_uploaded_file($_FILES["hinhanh"]["tmp_name"],'image/category/'.basename($_FILES["hinhanh"]["name"]));
  
  }
  //Sửa
  elseif(isset($_POST['submitud'])){
    $idcategory=$_POST['id_category'];
    $tencategory=$_POST['tag-name'];
    $mota=$_POST['description'];
    $hinhanh=$_FILES['hinhanh']['name'];
    if($hinhanh==''){
        $sql_update_image = "UPDATE category SET name_category='$tencategory',description='$mota' WHERE id_category='$idcategory'";
    }else{
      move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/category/'.basename($_FILES["hinhanh"]["name"]));
      $sql_update_image = "UPDATE category SET name_category='$tencategory',image_category='$hinhanh',description='$mota' WHERE id_category='$idcategory'";
    }
    mysqli_query($con,$sql_update_image);
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM category WHERE id_category='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/categorypost.css"></link>

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
                $idupdate=$_GET['idct'];
                $sql_update_category=mysqli_query($con, "SELECT * FROM category WHERE id_category='$idupdate'");
                $row_update_category=mysqli_fetch_array($sql_update_category);
                ?>
                <div class="col-4">
                    <form  method="POST" action="" enctype="multipart/form-data">
                        <div class="form-field">
                            <input type="hidden" name="id_category" value="<?php echo $row_update_category['id_category']?>">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_category['name_category']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label >Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                            <img  class="img-thumbnail" src="image/category/<?php echo $row_update_category['image_category']?>" width="20%" height="20%">

                        </div>
                        <div class="form-field ">
                            <label for="description">Mô tả</label>
                            <textarea name="description" class="form-context" id="description" rows="5" cols="50%"><?php echo $row_update_category['description']?></textarea>
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
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" data-success="right" type="text" class="form-control" required="required" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label>Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                        </div>
                        
                        <div class="form-field ">
                            <label for="description">Mô tả</label>
                            <textarea name="description" class="form-context" id="description" rows="5" cols="50%" placeholder="Không vượt quá ( ~ 200 ký tự )"></textarea>
                        </div>
                                    
                        <p class="submit">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Thêm Chuyên mục">	<span class="spinner"></span>
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
                    $sum_category_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_category_page;
                    $sql_select_category = mysqli_query($con,"SELECT * FROM category WHERE name_category like '%$tukhoa%' ORDER BY id_category DESC LIMIT $sum_category_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM category WHERE name_category like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_category_page);
                    ?>
                    <h5>Danh sách category</h5>
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
                    while($row_category = mysqli_fetch_array($sql_select_category)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/category/<?php echo $row_category['image_category'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_category['name_category']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_category['description']?></td>
                        
                            <td>

                            <a href="?admin_moc=Chuyenmuc&quanly==capnhap&idct=<?php echo $row_category['id_category'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Chuyenmuc&xoa=<?php echo $row_category['id_category']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    <h5>Danh sách category</h5>
                <?php
                    $sum_category_page= !empty($_GET['per-page'])?$_GET['per-page']:10;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_category_page;
                    $sql_select_category = mysqli_query($con,"SELECT * FROM category ORDER BY id_category DESC LIMIT $sum_category_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM category");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_category_page);

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
                    while($row_category = mysqli_fetch_array($sql_select_category)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/category/<?php echo $row_category['image_category'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_category['name_category']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_category['description']?></td>
                        
                            <td>
                            <a href="?admin_moc=Chuyenmuc&quanly==capnhap&idct=<?php echo $row_category['id_category'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Chuyenmuc&xoa=<?php echo $row_category['id_category']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Chuyenmuc&per-page=<?php echo $sum_category_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Chuyenmuc&per-page=<?php echo $sum_category_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Chuyenmuc&per-page=<?php echo $sum_category_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Chuyenmuc&per-page=<?php echo $sum_category_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Chuyenmuc&per-page=<?php echo $sum_category_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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