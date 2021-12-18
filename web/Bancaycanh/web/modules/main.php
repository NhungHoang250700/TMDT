<div class="main">
    <?php
    if(isset($_GET['web_moc'])){
        $tam=$_GET['web_moc'];
    }else{
        $tam="";
    }
    if($tam=='Trangchu'){
        include("trangchu.php");
    }elseif($tam=='Themvaogiohang'){
        include("cart.php");

    }elseif($tam=='Giohang'){
        include("totalcart.php");

    }elseif($tam=='Danhmucsanpham'){
        include("danhmuc.php");

    }elseif($tam=='Chitietsanpham'){
        include("productdetail.php");

    }elseif($tam=='Thanhtoan'){
        include("order.php");

    }elseif($tam=='Baiviet'){
        include("post.php");

    }elseif($tam=='Chitietbaiviet'){
        include("postdetail.php");

    }elseif($tam=='Timkiemsanpham'){
        include("search.php");

    }elseif($tam=='Tatcasanpham'){
        include("totalproduct.php");

    }elseif($tam=='Lienhe'){
        include("contact.php");

    }else{
        include("trangchu.php");
    }
   



    ?>
</div>