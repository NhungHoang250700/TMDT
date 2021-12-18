
<div class="main">
    <?php
        if(isset($_GET['admin_moc'])){
            $tam = $_GET['admin_moc'];
        }else{
            $tam = '';
        }
       if($tam=='Banner'){
            include("banner.php");
        }
        if($tam=='Chuyenmuc'){
            include("categorypost.php");
        }
        if($tam=='Thembaiviet'){
            include("newpost.php");
        }
        if($tam=='Tatcabaiviet'){
            include("totalpost.php");
        }
      
        if($tam=='Danhmuc'){
            include("productline.php");
        }
        if($tam=='Themsanpham'){
            include("newproduct.php");
        }
        if($tam=='Tatcasanpham'){
            include("totalproduct.php");
        }
        if($tam=='Donhang'){
            include("order.php");
        }
        if($tam=='Chitiethoadon'){
            include("orderdetail.php");
        }
        if($tam=='Khachhang'){
            include("customer.php");
        }
        if($tam=='Lienhe'){
            include("contact.php");
        }



    ?>
</div>