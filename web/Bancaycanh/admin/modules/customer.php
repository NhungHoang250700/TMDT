<?php
include '../db/config.php';
  //Sửa
  
//Xóa
if(isset($_GET['xoa'])){
    $idxoa=$_GET['xoa'];
    mysqli_query($con,"DELETE FROM orders WHERE id_customerorder='$idxoa'");

}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/customer.css"></link>

</head>
<body>
    <div class="container-fluid">
        <h5>Tất cả bài viết</h2>
        <form class="form-inline " method="POST" action="">
            <input name="tukhoa" class="form-context"  type="text" placeholder="Search" aria-label="Search">
            <input type="submit" class="form-context" name="Timkiem" value="Tìm kiếm">
        </form>

        <div class="row">



                <!-- ===================Search======================= -->

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_customerorder_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_customerorder_page;
                    $sql_select_customerorder = mysqli_query($con,"SELECT A.*, B.*, concat(B.lastName,' ',B.firstName) as Name FROM orders A, customerorders B WHERE A.id_customerorder=B.id_customerorder AND id_customerorder like '%$tukhoa%' ORDER BY id_customerorder DESC LIMIT $sum_customerorder_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM orders WHERE id_customerorder like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_customerorder_page);
                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th class="hidden-xs">Mã khách hàng</th>
                            <th>Tên</th>
                            <th>Ngày đặt</th>
                            <th class="hidden-sm hidden-xs">Ghi chú</th>
                            <th>Hủy đơn</th>
                            <th>Sửa</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_customerorder = mysqli_fetch_array($sql_select_customerorder)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                        <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_customerorder['id_customerorder']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['Name']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['orderDate']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['comment']?></td>

                            <td>
                                <?php if(($row_customerorder['status'])==1){ echo "Đã hủy"; }else{echo "";}?>
                            </td>
                            <td>

                            <a href="index.php?admin_moc=Chitiethoadon&idhd=<?php echo $row_customerorder['id_customerorder']?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Khachhang&xoa=<?php echo $row_customerorder['id_customerorder']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                    $sum_customerorder_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_customerorder_page;
                    $sql_select_customerorder = mysqli_query($con,"SELECT A.*,B.*,C.*, concat(A.lastName,' ',A.firstName) as Name FROM customerorders A, orders B, orderdetails C WHERE A.id_customerorder=B.id_customerorder AND B.orderNumber=C.orderNumber ORDER BY A.id_customerorder ASC LIMIT $sum_customerorder_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM customerorders");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_customerorder_page);

                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th class="hidden-xs">Mã khách hàng</th>
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th class="hidden-sm hidden-xs">Địa chỉ</th>
                            <th>Sửa</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    while($row_customerorder = mysqli_fetch_array($sql_select_customerorder)){
                        $i++;
                        ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_customerorder['id_customerorder']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['Name']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['phone']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_customerorder['address']?></td>

                            <td>

                            <a href="index_admin.php?admin_moc=Chitiethoadon&idhd=<?php echo $row_customerorder['orderNumber']?>"><button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                            <a href="?admin_moc=Khachhang&xoa=<?php echo $row_customerorder['orderNumber']?>" title="Xóa"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i>
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
                                <a class="page-link" href="?admin_moc=Khachhang&per-page=<?php echo $sum_customerorder_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Khachhang&per-page=<?php echo $sum_customerorder_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Khachhang&per-page=<?php echo $sum_customerorder_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Khachhang&per-page=<?php echo $sum_customerorder_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Khachhang&per-page=<?php echo $sum_customerorder_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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