<?php
include '../db/config.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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



                <!-- ===================Search======================= -->

                <?php
                if(isset($_POST['Timkiem'])){
                    $tukhoa=$_POST['tukhoa'];
                    $sum_orderdetail_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_orderdetail_page;
                    $sql_select_orderdetail = mysqli_query($con,"SELECT A.*, B.*, C.* ,(B.quantityOrder * C.buyPrice) as Total FROM orders A, orderdetails B, products C WHERE A.orderNumber = B.orderNumber AND B.productCode=C.productCode AND C.productName like '%$tukhoa%' ORDER BY A.orderNumber DESC LIMIT $sum_orderdetail_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM  orders A, orderdetails B, products C WHERE A.orderNumber = B.orderNumber AND B.productCode=C.productCode AND C.productName like '%$tukhoa%'");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_orderdetail_page);
                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                        <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th class="hidden-xs">Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Mức giá</th>
                            <th>Ngày đặt</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    $total=0;
                    while($row_orderdetail = mysqli_fetch_array($sql_select_orderdetail)){
                        $i++;
                        $subtotal = $row_orderdetail['quantityOrder'] * $row_orderdetail['buyPrice'];
                        $total+=$subtotal;
                        ?>
                    <tbody>
                        <tr>
                        <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_orderdetail['orderNumber']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['productName']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['quantityOrder']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['buyPrice']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['orderDate']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['Total']?></td>
                            
                        </tr>
                        
                    </tbody>
                    <?php
                    }
                    ?>
                    <tfoot> 
                        <tr> 
                            <td><a href="index_admin.php?admin_moc=Donhang" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>
                        </td> 
                        <td class="hidden-xs text-center"><strong>Tổng tiền <?php echo number_format($total).".000<sup>đ</sup>" ?></strong>
                    </td>
                </tr> 
        </tfoot> 
                </table>

                    <?php
                }else{
                    ?>
                <?php
                    $sum_orderdetail_page= !empty($_GET['per-page'])?$_GET['per-page']:3;
                    $current_page= !empty($_GET['page'])?$_GET['page']:1;
                    $offset=($current_page -1 ) * $sum_orderdetail_page;
                    $sql_select_orderdetail = mysqli_query($con,"SELECT A.*, B.*, C.* ,(B.quantityOrder * C.buyPrice) as Total FROM orders A, orderdetails B, products C WHERE A.orderNumber = B.orderNumber AND B.productCode=C.productCode AND A.orderNumber='$_GET[idhd]' ORDER BY A.orderNumber DESC LIMIT $sum_orderdetail_page OFFSET $offset");
                    $totalRecord=mysqli_query($con,"SELECT * FROM orderdetails");
                    $row_count=mysqli_num_rows($totalRecord);
                    $totalPages= ceil($row_count/$sum_orderdetail_page);

                    ?>
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th><input id="check_all" type="checkbox"></th>
                            <th class="hidden-xs">ID</th>
                            <th class="hidden-xs">Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Mức giá</th>
                            <th>Ngày đặt</th>
                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    $total=0;
                    while($row_orderdetail = mysqli_fetch_array($sql_select_orderdetail)){
                        $i++;
                        $subtotal = $row_orderdetail['quantityOrder'] * $row_orderdetail['buyPrice'];
                        $total+=$subtotal;
                                ?>
                    <tbody>
                        <tr>
                            <td>
                            <input name="id[]" type="checkbox" value="1">
                            </td>
                            <td class="hidden-xs"><?php echo $i?></td>
                            <td class="hidden-xs"><?php echo $row_orderdetail['orderNumber']?></td>

                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['productName']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['quantityOrder']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['buyPrice']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['orderDate']?></td>
                            <td class="hidden-sm hidden-xs"><?php echo $row_orderdetail['Total']?></td>
                            
                            
                        </tr>
                        
                    </tbody>
                    <?php
                    }
                    ?>
                    <tfoot> 
                        <tr> 
                            <td colspan="7"><a href="index_admin.php?admin_moc=Donhang" class="btn btn-warning"><i class="fa fa-angle-left"></i> Trở lại</a>
                        </td> 
                        <td class="hidden-xs text-center"><strong>Tổng tiền <?php echo number_format($total).".000<sup>đ</sup>" ?></strong>
                    </td>
                </tr> 
        </tfoot> 
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
                                <a class="page-link" href="?admin_moc=Chitiethoadon&per-page=<?php echo $sum_orderdetail_page?>&page=<?php echo $fist_page?>">First</a>
                            </li>
                            <?php
                        }if($current_page > 1){
                            $prev_page=$current_page-1;
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?admin_moc=Chitiethoadon&per-page=<?php echo $sum_orderdetail_page?>&page=<?php echo $prev_page?>"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php for($num=1;$num <= $totalPages;$num++){
                            if($num != $current_page){
                                if($num > $current_page -2 && $num <= $current_page + 2){
                                    ?>
                                    <li class="page-item">
                                    <a class="page-link" href="?admin_moc=Chitiethoadon&per-page=<?php echo $sum_orderdetail_page?>&page=<?php echo $num?>"><?php echo $num?></a>
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
                                    <a class="page-link" href="?admin_moc=Chitiethoadon&per-page=<?php echo $sum_orderdetail_page?>&page=<?php echo $next_page?>">Next</a>
                                </li>
                                <?php
                                }if($current_page < $totalPages - 2){
                                    $end_page=$totalPages;
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?admin_moc=Chitiethoadon&per-page=<?php echo $sum_orderdetail_page?>&page=<?php echo $end_page?>"><span aria-hidden="true">&raquo;</span></a>
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