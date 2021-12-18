<?php
include '../db/config.php';
//Thêm
if(isset($_POST['submit'])){
    $tenlienhe=$_POST['tag-name'];
    $diachi=$_POST['tag-address'];
    $dienthoai=$_POST['tag-phone'];
    $mail=$_POST['tag-email'];
    $mathue=$_POST['tag-tax'];
    $bando=$_POST['map'];

    $sql_insert_contact= mysqli_query($con, "INSERT INTO contacts(`contactName`, `contactAdress`, `contactPhone`, `contactEmail`, `contacsTaxCode`, `contactMap`) VALUES ('$tenlienhe','$diachi','$dienthoai','$mail','$mathue','$bando')");
  
  }
  //Sửa
  elseif(isset($_POST['submitud'])){
    $idliehe=$_POST['contactId'];
    $tenlienhe=$_POST['tag-name'];
    $diachi=$_POST['tag-address'];
    $dienthoai=$_POST['tag-phone'];
    $mail=$_POST['tag-email'];
    $mathue=$_POST['tag-tax'];
    $bando=$_POST['map'];

    $sql_update_contact =mysqli_query($con,"UPDATE contacts SET contactName='$tenlienhe',contactAddress='$diachi',contactPhone='$dienthoai',contactEmail='$mail', contacsTaxCode='$mathue', contactMap='$bando' WHERE contactId='$idliehe'");
}
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM contacts WHERE contactId='$idxoa'");

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
        <h5>Liên hệ</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row">
            <?php
            if(isset($_GET['quanly'])=='capnhap'){
                $idupdate=$_GET['idbn'];
                $sql_update_contact=mysqli_query($con, "SELECT * FROM contacts WHERE contactId='$idupdate'");
                $row_update_contact=mysqli_fetch_array($sql_update_contact);
                ?>
                <div class="col-4">
                    <form  method="POST" action="" enctype="multipart/form-data">
                    <div class="form-field">
                            <input type="hidden" name="contactId" value="<?php echo $row_update_contact['contactId']?>">
                            <label for="tag-name">Tên</label>
                            <input name="tag-name" class="form-context" id="tag-name" type="text" value="<?php echo $row_update_contact['contactName']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-address">Địa chỉ</label>
                            <input name="tag-address" class="form-context" id="tag-address" type="text" value="<?php echo $row_update_contact['contactAddress']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-phone">Điện thoại</label>
                            <input name="tag-phone" class="form-context" id="tag-phone" type="text" value="<?php echo $row_update_contact['contactPhone']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-email">Email</label>
                            <input name="tag-email" class="form-context" id="tag-email" type="text" value="<?php echo $row_update_contact['contactEmail']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-tax">Mã thuế</label>
                            <input name="tag-tax" class="form-context" id="tag-tax" type="text" value="<?php echo $row_update_contact['contacsTaxCode']?>" size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>


                        
                        <div class="form-field ">
                            <label for="map">Bản đồ</label>
                            <textarea name="map" class="form-context" id="map" rows="5" cols="50%"><?php echo $row_update_contact['contactMap']?></textarea>
                        </div>
                                    
                       
                        <p class="submit">
                            <input type="submit" name="submitud" id="submit" class="btn btn-primary" value="Chỉnh sửa Banner">	<span class="spinner"></span>
                            <a href="index_admin.php?admin_moc=Lienhe" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>

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
                            <input name="tag-name" data-success="right" type="text" class="form-control" required="required"  size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-address">Địa chỉ</label>
                            <input name="tag-address" data-success="right" type="text" class="form-control" required="required"  size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-phone">Điện thoại</label>
                            <input name="tag-phone" data-success="right" type="text" class="form-control" required="required"  size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-email">Email</label>
                            <input name="tag-email" class="form-context" id="tag-email" type="text"  size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>
                        <div class="form-field">
                            <label for="tag-tax">Mã thuế</label>
                            <input name="tag-tax" data-success="right" type="text" class="form-control" required="required"  size="40" aria-required="true">
                            <p>Tên riêng sẽ hiển thị trên trang mạng của bạn.</p>
                        </div>


                        
                        <div class="form-field ">
                            <label for="map">Bản đồ</label>
                            <textarea name="map" class="form-context" id="map" rows="5" cols="50%"></textarea>
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
                    $sum_contact_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_contact_page;
                    $sql_select_contact = mysqli_query($con,"SELECT * FROM contacts WHERE contactName like '%$tukhoa%' ORDER BY contactId DESC LIMIT $sum_contact_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM contacts WHERE contactName like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_contact_page);
                    ?>
                    <h5>Danh sách </h5>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th >Điện thoại</th>
                            <th>Email</th>
                            <th>Mã thuế</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_contact =mysqli_fetch_array($sql_select_contact)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                           
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactName']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactAddress']?></td>
                           
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactPhone']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactEmail']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactTaxCode']?></td>


                            <td>

                            <a href="?admin_moc=Lienhe&quanly==capnhap&idbn=<?php echo $row_contact['contactId'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Lienhe&xoa=<?php echo $row_contact['contactId']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    <h5>Danh sách liên hệ</h5>
                <?php
                    $sum_contact_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_contact_page;
                    $sql_select_contact = mysqli_query($con,"SELECT * FROM contacts ORDER BY contactId DESC LIMIT $sum_contact_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM contacts");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_contact_page);

                    ?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th >Điện thoại</th>
                            <th>Email</th>
                            <th>Mã thuế</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_contact =mysqli_fetch_array($sql_select_contact)){
                        $i++;
                        ?>
                    <tbody>
                    <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                           
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactName']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactAddress']?></td>
                           
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactPhone']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contactEmail']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_contact['contacsTaxCode']?></td>


                            <td>

                            <a href="?admin_moc=Lienhe&quanly==capnhap&idbn=<?php echo $row_contact['contactId'] ?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Lienhe&xoa=<?php echo $row_contact['contactId']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Lienhe&per-page=<?php echo $sum_contact_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Lienhe&per-page=<?php echo $sum_contact_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Lienhe&per-page=<?php echo $sum_contact_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Lienhe&per-page=<?php echo $sum_contact_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Lienhe&per-page=<?php echo $sum_contact_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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