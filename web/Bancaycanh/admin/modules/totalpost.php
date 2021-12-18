<?php
include '../db/config.php';
  //Sửa
  if(isset($_POST['submitud'])){
    $idbanner=$_POST['id_post'];
    $tenpost=$_POST['tag-name'];
    $mota=$_POST['cummeryPost'];
    $noidung=$_POST['contentPost'];
    $chuyenmuc=$_POST['category'];  
    $trangthai=$_POST['statusBanner'];
    $hinhanh=$_FILES['hinhanh']['name'];
    if($hinhanh==''){
        $sql_update_image = "UPDATE newpost SET name_post='$tenpost',summery_post='$mota',content_post='$noidung',id_category='$chuyenmuc',status_display_post='$trangthai' WHERE id_post='$idbanner'";
    }else{
      move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/post/'.basename($_FILES["hinhanh"]["name"]));
      $sql_update_image = "UPDATE newpost SET name_post='$tenpost',image_post='$hinhanh',summery_post='$mota',content_post='$noidung',id_category='$chuyenmuc',status_display_post='$trangthai' WHERE id_post='$idbanner'";
    }
    mysqli_query($con,$sql_update_image);
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM newpost WHERE id_post='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/totalpost.css"></link>

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
                $idupdate=$_GET['idpt'];
                $sql_update_post=mysqli_query($con, "SELECT * FROM newpost WHERE id_post='$idupdate'");
                $row_update_post=mysqli_fetch_array($sql_update_post);
                $id_post_update=$row_update_post['id_category'];

                ?>
                    <form  method="POST" action="" enctype="multipart/form-data">
                        <div class="form-field">
                            <input type="hidden" name="id_post" value="<?php echo $row_update_post['id_post']?>">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_post['name_post']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="ig">
                            <label >Hình ảnh</label>
                            <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">
                            <img  class="img-thumbnail" src="image/post/<?php echo $row_update_post['image_post']?>" width="20%" height="20%">

                        </div>
                        <div class="form-field ">
                            <label for="cummeryPost">Mô tả</label>
                            <textarea name="cummeryPost" class="form-context" id="cummeryPost" rows="5" cols="50%"><?php echo $row_update_post['summery_post']?></textarea>
                        </div>
                        <div class="form-field ">
                            <label for="contentPost">Nội dung</label>
                            <textarea name="contentPost" class="form-context" id="contentPost" rows="10" cols="100%"><?php echo $row_update_post['content_post']?></textarea>
                        </div>
                        <div class="form-field ">Danh mục bài viết
                            <select name="category" class="form-context">
                                <option value='-1'disabled>-----Chọn chuyên mục-----</option>				
                                <?php
                                    $sql_category_post= mysqli_query($con, "SELECT * FROM category ORDER BY id_category DESC");
                                    while ($row_danhmuc = mysqli_fetch_array($sql_category_post)) {
                                        if($id_post_update==$row_danhmuc['id_category']){

                                ?>
                                <option selected value="<?php echo $row_danhmuc['id_category'] ?>" >
                                    <?php echo $row_danhmuc['name_category']?>
                                </option>
                                <?php
                                } else{
                                ?>
                                <option value="<?php echo $row_danhmuc['id_category'] ?>" >
                                    <?php echo $row_danhmuc['name_category']?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                                </select>
                            </div>
                                    
                        <div class="form-field ">Tình trạng
                            <select name="statusBanner" class="form-context">
                            <?php
                            if($row_update_post['status_display_post']==1){ 
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
                            <a href="index_admin.php?admin_moc=Tatcabaiviet" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>

                        </p>
                    </form>
              

            <?php
            }
                ?>

                <!-- ===================Search======================= -->

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_post_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_post_page;
                    $sql_select_post = mysqli_query($con,"SELECT * FROM newpost WHERE name_post like '%$tukhoa%' ORDER BY id_post DESC LIMIT $sum_post_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM newpost WHERE name_post like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_post_page);
                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Mô tả</th>
                            <th>Tình trạng</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_post = mysqli_fetch_array($sql_select_post)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/post/<?php echo $row_post['image_post'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_post['name_post']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_post['summery_post']?></td>
                           
                            <td>
                                <?php if(($row_post['status_display_post'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
                            </td>
                            <td>

                            <a href="?admin_moc=Tatcabaiviet&quanly==capnhap&idpt=<?php echo $row_post['id_post'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Tatcabaiviet&xoa=<?php echo $row_post['id_post']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    $sum_post_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_post_page;
                    $sql_select_post = mysqli_query($con,"SELECT * FROM newpost ORDER BY id_post DESC LIMIT $sum_post_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM newpost");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_post_page);

                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th class="hidden-sm hidden-xs">Mô tả</th>
                            <th>Tình trạng</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_post = mysqli_fetch_array($sql_select_post)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td>
                            <img class="img-thumbnail" src="image/post/<?php echo $row_post['image_post'] ?>" alt="" width="100px">
                            </td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_post['name_post']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_post['summery_post']?></td>
                           
                            <td>
                                <?php if(($row_post['status_display_post'])==1){ echo "Kích hoạt"; }else{echo "Ẩn";}?>
                            </td>
                            <td>

                            <a href="?admin_moc=Tatcabaiviet&quanly==capnhap&idpt=<?php echo $row_post['id_post'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Tatcabaiviet&xoa=<?php echo $row_post['id_post']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Tatcabaiviet&per-page=<?php echo $sum_post_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Tatcabaiviet&per-page=<?php echo $sum_post_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Tatcabaiviet&per-page=<?php echo $sum_post_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Tatcabaiviet&per-page=<?php echo $sum_post_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Tatcabaiviet&per-page=<?php echo $sum_post_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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