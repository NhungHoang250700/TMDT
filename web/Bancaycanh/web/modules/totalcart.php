<?php
include '../db/config.php';
if(isset($_GET['xoa'])){
  $id = $_GET['xoa'];
  $sql_delete = mysqli_query($con,"DELETE FROM cart WHERE cartId='$id'");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="container">
 <table id="cart" class="table table-hover table-condensed"> 
  <thead> 
   <tr> 
    <th style="width:50%">Tên sản phẩm</th> 
    <th style="width:10%">Giá</th> 
    <th style="width:8%">Số lượng</th> 
    <th style="width:22%" class="text-center">Thành tiền</th> 
    <th style="width:10%"> </th> 
   </tr> 
  </thead> 
  <tbody>
  <?php
  $id_ct=$_SESSION['customerName'];
  $sql_select_customer = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$id_ct'");
  $row_customerNumber = mysqli_fetch_array($sql_select_customer);
  $idctm=$row_customerNumber['customerNumber'];
  $sql_select_cart=mysqli_query($con,"SELECT A.*,B.* FROM cart A, products B WHERE A.productCode=B.productCode AND A.customerNumber='$idctm'");
      $i=0;
      $total=0;
      while($row_cart = mysqli_fetch_array($sql_select_cart)){
        $i++;
        $subtotal = $row_cart['productQuantity'] * $row_cart['buyPrice'];
				$total+=$subtotal;
      ?>
    <tr> 
   <td data-th="Product">
    <div class="row"> 
     <div class="col-sm-3 hidden-xs"><img src="../admin/image/product/<?php echo $row_cart['productImage']?>" alt="Sản phẩm 1" class="img-responsive" width="100">
     </div> 
     <div class="col-sm-8"> 
      <h4 class="nomargin"><?php echo $row_cart['productName']?></h4> 
     </div> 
    </div> 
   </td> 
   <td data-th="Price"><?php echo number_format($row_cart['buyPrice']).".000<sup>đ</sup>"?></td> 
   <td data-th="Quantity">
   <input type="hidden" name="product_id[]" value="<?php echo $row_cart['productCode'] ?>">

   <input type="number" name="numberQuantity" min="1" max="<?php echo $row_cart['quantityInStock'] ?>" name="soluong[]" value="<?php echo $row_cart['productQuantity'] ?>">
     <!-- <a href="?web_moc=Giohang&cong=<?php echo $row_cart['cartId']?>"><i class="fa fa-plus fa-style" aria-hidden="true"></i></a>
    	<?php echo $row_cart['productQuantity'] ?>
    	<a href="?web_moc=Giohang&tru=<?php echo $row_cart['cartId']?>"><i class="fa fa-minus fa-style" aria-hidden="true"></i></a> -->
    </td> 
   <td data-th="Subtotal" class="text-center"><?php echo number_format($subtotal).".000<sup>đ</sup>" ?></td> 
   <td class="actions" data-th="">
   
    <a href="?web_moc=Giohang&xoa=<?php echo $row_cart['cartId']?>" title="Xóa"><button class="btn "><i class="fa fa-trash-o"></i>
      </a>  
 
   </td> 
  </tr> 
  <tr> 
   <?php
  }
  ?>
  </tbody><tfoot> 
  
   <tr> 
    <td><a href="index.php?web_moc=Trangchu" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
    </td> 
    <td colspan="2" class="hidden-xs"> </td> 
    <td class="hidden-xs text-center"><strong>Tổng tiền <?php echo number_format($total).".000<sup>đ</sup>" ?></strong>
    </td> 
    <td><a href="index.php?web_moc=Thanhtoan" class="btn btn-success btn-block">Đặt hàng</a>
    </td> 
   </tr> 
  </tfoot> 
 </table>

</div>
</body>
</html>