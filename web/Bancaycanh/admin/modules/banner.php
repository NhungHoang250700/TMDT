<?php
include '../db/config.php';
//Thêm
if(isset($_POST['submit'])){
    $tenbanner=$_POST['tag-name'];
    $mota=$_POST['caption'];
    $trangthai=$_POST['statusBanner'];
    $hinhanh=$_FILES['hinhanh']['name'];
    $sql_insert_banner= mysqli_query($con, "INSERT INTO banner( `name_banner`, `image_banner`, `caption_banner`, `active_banner`) VALUES ('$tenbanner','$hinhanh','$mota','$trangthai')");
    move_uploaded_file($_FILES["hinhanh"]["tmp_name"],'image/banner/'.basename($_FILES["hinhanh"]["name"]));
  
  }
  //Sửa
  elseif(isset($_POST['submitud'])){
    $idbanner=$_POST['id_banner'];
    $tenbanner=$_POST['tag-name'];
    $mota=$_POST['caption'];
    $trangthai=$_POST['statusBanner'];
    $hinhanh=$_FILES['hinhanh']['name'];
    if($hinhanh==''){
        $sql_update_image = "UPDATE banner SET name_banner='$tenbanner',caption_banner='$mota',active_banner='$trangthai' WHERE id_banner='$idbanner'";
    }else{
      move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/banner/'.basename($_FILES["hinhanh"]["name"]));
      $sql_update_image = "UPDATE banner SET name_banner='$tenbanner',image_banner='$hinhanh',caption_banner='$mota',active_banner='$trangthai' WHERE id_banner='$idbanner'";
    }
    mysqli_query($con,$sql_update_image);
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM banner WHERE id_banner='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/banner.css"></link>

</head>
<body>
    <div class="container-fluid">
        <h5>Banner</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row">
            <?php
            if(isset($_GET['quanly'])=='capnhap'){
                $idupdate=$_GET['idbn'];
                $sql_update_banner=mysqli_query($con, "SELECT * FROM banner WHERE id_banner='$idupdate'");
                $row_update_banner=mysqli_fetch_array($sql_update_banner);
                ?>
                <div class="col-4">
                    <form  method="POST" action="" enctype="multipart/form-data">
                        <div class="form-field">
                            <input type="hidden" name="id_banner" value="<?php echo $row_update_banner['id_banner']?>">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_banner['name_banner']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label >Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                            <img  class="img-thumbnail" src="image/banner/<?php echo $row_update_banner['image_banner']?>" width="20%" height="20%">

                        </div>
                        <div class="form-field ">
                            <label for="caption">Nội dung</label>
                            <textarea name="caption" class="form-context" id="caption" rows="5" cols="50%"><?php echo $row_update_banner['caption_banner']?></textarea>
                        </div>
                                    
                        <div class="form-field ">Tình trạng
                            <select name="statusBanner" class="form-context">
                            <?php
                            if($row_update_banner['active_banner']==1){ 
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
                            <input type="submit" name="submitud" id="submit" class="btn btn-primary" value="Chỉnh sửa Banner">	<span class="spinner"></span>
                            <a href="index_admin.php?admin_moc=Banner" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>

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
                            <label for="caption">Nội dung</label>
                            <textarea name="caption" class="form-context" id="caption" rows="5" cols="50%" placeholder="Không vượt quá ( ~ 200 ký tự )"></textarea>
                        </div>
                                    
                        <div class="form-field ">Tình trạng
                            <select name="statusBanner" class="form-context">
                                <option value="1">Kích hoạt</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <p class="submit">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Thêm Banner">	<span class="spinner"></span>
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
                    $sum_banner_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_banner_page;
                    $sql_select_banner = mysqli_query($con,"SELECT * FROM banner WHERE name_banner like '%$tukhoa%' ORDER BY id_banner DESC LIMIT $sum_banner_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM banner WHERE name_banner like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_banner_page);
                    ?>
                    <h5>Danh sách banner</h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Nội dung</th>
                            <th>Tình trạng</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_banner = mysqli_fetch_array($sql_select_banner)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/banner/<?php echo $row_banner['image_banner'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_banner['name_banner']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_banner['caption_banner']?></td>
                           
                            <td>
                                <?php if(($row_banner['active_banner'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
                            </td>
                            <td>

                            <a href="?admin_moc=Banner&quanly==capnhap&idbn=<?php echo $row_banner['id_banner'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Banner&xoa=<?php echo $row_banner['id_banner']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    <h5>Danh sách banner</h5>
                <?php
                    $sum_banner_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_banner_page;
                    $sql_select_banner = mysqli_query($con,"SELECT * FROM banner ORDER BY id_banner DESC LIMIT $sum_banner_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM banner");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_banner_page);

                    ?>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Nội dung</th>
                            <th>Tình trạng</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_banner = mysqli_fetch_array($sql_select_banner)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/banner/<?php echo $row_banner['image_banner'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_banner['name_banner']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_banner['caption_banner']?></td>
                           
                            <td>
                                <?php if(($row_banner['active_banner'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
                            </td>
                            <td>

                            <a href="?admin_moc=Banner&quanly==capnhap&idbn=<?php echo $row_banner['id_banner'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Banner&xoa=<?php echo $row_banner['id_banner']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Banner&per-page=<?php echo $sum_banner_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Banner&per-page=<?php echo $sum_banner_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Banner&per-page=<?php echo $sum_banner_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Banner&per-page=<?php echo $sum_banner_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Banner&per-page=<?php echo $sum_banner_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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