<?php
include '../db/config.php';
	if(isset($_SESSION['customerName'])){
	

$id_ct=$_SESSION['customerName'];
$sql_select_customer = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$id_ct'");
$row_customerNumber = mysqli_fetch_array($sql_select_customer);
$id=$row_customerNumber['customerNumber'];

// $sql_insert_pd=mysqli_query($con," INSERT INTO cart(productCode, productQuantity) VALUE('$_GET[idspgh]','1')");
$sql_select_giohang = mysqli_query($con,"SELECT * FROM cart  WHERE productCode='$_GET[idspgh]' AND customerNumber='$id'");
 	$count = mysqli_num_rows($sql_select_giohang);
 	if($count>0){
 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
		 
 		$soluong = $row_sanpham['productQuantity'] + 1;
 		$sql_giohang = "UPDATE cart SET productQuantity='$soluong' WHERE productCode='$_GET[idspgh]'";
	
 	}else{
 		$soluong = 1;
 		$sql_giohang = "INSERT INTO cart(productCode, productQuantity, customerNumber) values ('$_GET[idspgh]','$soluong','$id')";

 	}
 	$insert_row = mysqli_query($con,$sql_giohang);
}

?>