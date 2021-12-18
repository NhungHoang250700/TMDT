<?php
include '../db/config.php';
if(isset($_POST['submit'])){
    $ho=$_POST['last-name'];
    $ten=$_POST['first-name'];
    $sdt=$_POST['sdt'];
    $diachi=$_POST['address'];
    $ghichu=$_POST['comment'];

    $id_ct=$_SESSION['customerName'];
    $sql_select_customer = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$id_ct'");
    $row_customerNumber = mysqli_fetch_array($sql_select_customer);
    $idctm=$row_customerNumber['customerNumber'];
    $sql_customerorder=mysqli_query($con,"INSERT INTO customerorders(`firstName`, `lastName`, `phone`, `address`, `customerNumber`) VALUE('$ho','$ten','$sdt','$diachi',$idctm)");
    $sql_select_ct=mysqli_query($con,"SELECT * FROM customerorders ORDER BY id_customerorder DESC LIMIT 1");
    $row_idcustomerorder=mysqli_fetch_array($sql_select_ct);
    $idctod=$row_idcustomerorder['id_customerorder'];
    $sql_order=mysqli_query($con,"INSERT INTO orders(`comment`, `id_customerorder`) VALUES ('$ghichu', $idctod)");
    $sql_select_od=mysqli_query($con,"SELECT * FROM orders ORDER BY orderNumber DESC LIMIT 1");
    $row_order=mysqli_fetch_array($sql_select_od);
    $odnb=$row_order['orderNumber'];
    $sql_product=mysqli_query($con,"SELECT A.*,B.* FROM cart A, products B WHERE A.productCode=B.productCode AND A.customerNumber='$idctm'");
    while ($row_product = mysqli_fetch_array($sql_product)) {
    $sanpham=$row_product['productCode'];
    $soluong=$row_product['productQuantity'];
    mysqli_query($con,"INSERT INTO orderdetails(orderNumber,productCode,quantityOrder) VALUE($odnb,$sanpham,$soluong)");

    }



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/order.css" class="css">
    <style>
	
    .order-form .container {
      color: #4c4c4c;
      padding: 20px;
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1);
    }

    .order-form-label {
      margin: 8px 0 0 0;
      font-size: 14px;
      font-weight: bold;
    }

    .order-form-input {
      width: 100%;
      padding: 8px 8px;
      border-width: 1px !important;
      border-style: solid !important;
      border-radius: 3px !important;
      font-family: 'Open Sans', sans-serif;
      font-size: 14px;
      font-weight: normal;
      font-style: normal;
      line-height: 1.2em;
      background-color: transparent;
      border-color: #cccccc;
    }

    .btn-submit:hover {
      background-color: #090909 !important;
    }
</style>

</head>
<body>
    <div class="container ">
    <div class="col-12 my-4 text-uppercase font13 cl_nau" id="breadcrumbs"><span><span>
      <a href="index.php?web_moc=Trangchu">Trang chủ</a>
      <i class="fa fa-angle-right"></i>
      <span class="breadcrumb_last" aria-current="page">Thanh toán</span></span></span>
    </div>
   
        <div class="row">
            <div class="col-7">
                <div class="container ">
                    <div class="row">
                        <div class="col-12">
                        <form method="POST" action="">

                            <div class="col-12">
                                <h4>Thông tin khách hàng</h4>
                                <hr class="mt-1">
                            </div>
                            <div class="row mx-4">

                                <div class="col-12 mb-2">
                                    <div class="row">
                                    <div class="col-6">
                                    <label class="order-form-label">Họ</label>
                                    </div>
                                    <div class="col-6">
                                    <label class="order-form-label">Tên</label>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                                    <input class="order-form-input" data-success="right" type="text" name="last-name" placeholder="Họ" class="form-control" required="required">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input class="order-form-input" data-success="right" name="first-name" type="text" placeholder="Tên" class="form-control" required="required">
                                </div>
                                
                                
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Số điện thoại</label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input" data-success="right" name="sdt" type="text" placeholder="Điện thoại" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Địa chỉ</label>
                                </div>
                                <div class="col-12">
                                    <input class="order-form-input" data-success="right" name="address" type="text" placeholder="Tỉnh/Tp, Quận/Huyện, Phường/Xã" class="form-control" required="required">
                                </div>
                            </div> 
                            <div class="row mt-3 mx-4">
                                <div class="col-12">
                                    <label class="order-form-label">Ghi chú</label>
                                </div>
                                <div class="col-12">
                                    <textarea name="comment" name="decription" class="order-form-input" cols="60" rows="5"></textarea>
                                </div>
                            </div> 
                            <div class="row mt-3">
                                <div class="col-12">
                                <input type="submit" name="submit" id="submit"  class="btn btn-dark d-block mx-auto btn-submit" value="Thanh toán">
                                <!-- <button type="button" id="btnSubmit" name="submit" class="btn btn-dark d-block mx-auto btn-submit">Submit</button> -->
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="container d-flex justify-content-center mt-100">
                    <div class="container">
                        <div>
                            <h4>Đơn hàng của bạn</h4>
                        </div>
                        <div class="row">
                            
                        
                            <table class="table">
                                <colgroup>
                                <col width="auto" span="1">
                                <col width="100px" span="1">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-total">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total=0;
                                $id_ct=$_SESSION['customerName'];
                                $sql_select_customer = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$id_ct'");
                                $row_customerNumber = mysqli_fetch_array($sql_select_customer);
                                $idctm=$row_customerNumber['customerNumber'];
                                $sql_product=mysqli_query($con,"SELECT A.*,B.* FROM cart A, products B WHERE A.productCode=B.productCode AND A.customerNumber='$idctm'");
                                while ($row_product = mysqli_fetch_array($sql_product)) {
                                    $subtotal = $row_product['productQuantity'] * $row_product['buyPrice'];
                                    $total+=$subtotal;

                                    ?>
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            <img class="img-fluid" width="30px" src="../admin/image/product/<?php echo $row_product['productImage']?>">
                                            <small><?php echo $row_product['productName']?></small>&nbsp;
                                            <strong class="product-quantity" >×&nbsp;<?php echo $row_product['productQuantity']?></strong>											
                                        </td>
                                       
                                        <td class="product-total">
                                            <bdi><?php echo $subtotal.".000<sup>đ</sup>"?></bdi>					
                                        </td>
                                    </tr>
								</tbody>
                                <?php
                                }
                                ?>
                                <tfoot>
									<tr class="cart-subtotal">
										<th>Tạm tính</th>
										<td><bdi><?php echo $total.".000<sup>đ</sup>"?></bdi></td>
									</tr>
										
									</tfoot>
								</table>
                                
                            </div>
                            <h6>Chi tiết đơn hàng</h6>
                            <div class="row">
                                <div class="col-xs-6">
                                    <ul type="none">
                                        <li class="left">Ngày đặt:</li>
                                        <li class="left">Tổng tiền hàng:</li>
                                        <li class="left">Phí vận chuyển:</li>
                                        <li class="left">Tổng thanh toán:</li>
                                    </ul>
                                </div>
                                <div class="col-xs-6">
                                    <ul class="right" type="none">
                                        <li class="right"><?phpecho date("d-m-Y");?></li>
                                        <li class="right"><?php echo $total.".000<sup>đ</sup>"?></li>
                                        <li class="right">Miễn phí vận chuyển</li>
                                        <li class="right"><?php echo $total.".000<sup>đ</sup>"?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Modal footer -->
                    <div class="modal-footer"> <button type="button" class="btn">Track order</button> </div>
				</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


 <!-- Button to Open the Modal 
	<button type="button" class="btn openmodal" data-toggle="modal" data-target="#modal1"> Click here </button> The Modal
    <div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                Modal Header
                <div class="modal-header">
                    <h4 class="modal-title">Adidas Yeezy Boost 350 V2<br> Limited Edition</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> Modal body
                <div class="modal-body"> -->
