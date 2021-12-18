<?php
include '../db/config.php';
session_start();

if(isset($_POST["submit_login"])) {
    $taikhoan=$_POST["customerName"];
    $matkhau=$_POST["password"];

    if($taikhoan == ''|| $matkhau==''){
        echo '<script>alert("Làm ơn không để trống")</script>';
    }
    else{
        $sql_selecter_admin= mysqli_query($con, "SELECT * FROM `customers` WHERE customerName='$taikhoan' AND password='$matkhau' LIMIT 1");
        $count=mysqli_num_rows($sql_selecter_admin);
        $kq_login=mysqli_fetch_array($sql_selecter_admin);
       
        if($count>0){
            $f_user=$kq_login['customerName'];
            $f_pass=$kq_login['password'];    
            
            $_SESSION['customerName']= $f_user;
            $_SESSION['password']= $f_pass;
            
            header('Location: index.php?web_moc=Trangchu');
        }
        else{
            echo '<script>alert("Tài khoản hoặc mật khẩu sai")</script>';
        }
    }
    exit();
 }
 elseif(isset($_POST['submit_register'])){
    $name = $_POST['customerName'];
     $email = $_POST['email'];
     $password = md5($_POST['password']);
     $sql_khachhang = mysqli_query($con,"INSERT INTO customers(customerName,email,password) values ('$name','$email','$password')");
     $sql_select_khachhang = mysqli_query($con,"SELECT * FROM customers ORDER BY customerNumber DESC LIMIT 1");
     $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
     $_SESSION['customerName'] = $name;
    $_SESSION['customerNumber'] = $row_khachhang['customerNumber'];
    header('Location: index.php');

   
}
if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['customerName']);
    header('Location:index.php?web_moc=Trangchu');

}
    
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>
    <link rel="stylesheet" href="css/style_header.css" class="css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Marcellus SC' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header_top">
            <div class="container">
                <div class="row">
                
                    <div class="col-8 header_language">
                        
                        <a>Ngôn ngữ</a>
                        <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a>Vietnamese</a></li>
                            <li><a>English</a></li>
                        </ul>
                    </div>

                    <div class="col-4 header_admin">
                        <?php
                        if(!isset($_SESSION['customerName'])){
                        
                        ?>
                        <div class="register">
                            <div class="text-center">
                                    <!-- Button HTML (to Trigger Modal) -->
                                    <a href="#myModal1" class="trigger-btn" data-toggle="modal"><i class="fa fa-key"></i>Đăng ký</a>
                                </div>

                                <!-- Modal HTML -->
                                <div id="myModal1" class="modal fade">
                                    <div class="modal-dialog modal-login">
                                        <div class="modal-content" >
                                            <form action="" method="post">
                                                <div class="modal-header">				
                                                    <h4 class="modal-title">TẠO TÀI KHOẢN</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">				
                                                    <div class="form-group">
                                                        <label>Tên của bạn</label>
                                                        <input name="customerName" data-success="right" type="text" class="form-control" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input name="email" data-success="right" type="email" class="form-control" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="clearfix">
                                                            <label>Password</label>
                                                            <a href="#" class="float-right text-muted"><small>Forgot?</small></a>
                                                        </div>
                                                        
                                                        <input name="password" type="password" class="form-control" required="required">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <label class="form-check-label"><input type="checkbox"> Remember me</label>
                                                    <input type="submit" class="btn btn-primary" value="Login" name="submit_register">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- ========================================== -->
                            <div class="login">
                                <div class="text-center">
                                    <!-- Button HTML (to Trigger Modal) -->
                                    <a href="#myModal" class="trigger-btn" data-toggle="modal"><i class="fa fa-sign-in"></i>Đăng nhập</a>
                                </div>

                                <!-- Modal HTML -->
                                <div id="myModal" class="modal fade">
                                    <div class="modal-dialog modal-login">
                                        <div class="modal-content" >
                                            <form action="" method="post">
                                                <div class="modal-header">				
                                                    <h4 class="modal-title">Login</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">				
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input name="customerName" data-success="right" type="text" class="form-control" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="clearfix">
                                                            <label>Password</label>
                                                            <a href="#" class="float-right text-muted"><small>Forgot?</small></a>
                                                        </div>
                                                        
                                                        <input name="password" type="password" class="form-control" required="required">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <label class="form-check-label"><input type="checkbox"> Remember me</label>
                                                    <input type="submit" class="btn btn-primary" value="Login" name="submit_login">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- =========================================== -->
                            <div class="cart">
                                <a href="index.php?web_moc=Giohang"><i class="fa fa-shopping-cart"></i></i><sup>
                                    <span>
                                       0
                                    </span></sup>
                                </a>    
                            </div>
                        </div>
                        <?php
                        }else{
                            ?>
                        <div class="cart">
                            <a href="index.php?web_moc=Giohang"><i class="fa fa-shopping-cart"></i><sup>
                                <span>
                                    <?php 
                                        $name=$_SESSION['customerName'];
                                        $sql_select_khachhang = mysqli_query($con,"SELECT * FROM customers WHERE customerName='$name' LIMIT 1");
                                        $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
                                        $idnb = $row_khachhang['customerNumber'];
                                        $sql_select_cart = mysqli_query($con,"SELECT count(cartID) as Tong FROM cart WHERE customerNumber='$idnb' LIMIT 1");
                                        $row_cart = mysqli_fetch_array($sql_select_cart);
                                        $tong=$row_cart['Tong'];
                                        echo "$tong";
                                        ?>
                                </span></sup>
                            </a>    
                        </div>
                        <div class="col-10 header_language" >
                            <a><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php echo $_SESSION['customerName'];?></a>
                            <div class="profile_logout">
                            <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="index.php?dangxuat=1">Đăng xuất</a></li>
                        </ul>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                
                </div>
            
            </div>
        </div>
        <div class="container">
            <div class="header_shop">
                <div class="logo-image-text-slogan">
                    <a href="index.php?web_moc=Trangchu" class="custom-logo-link">
                        <img src="image/logo.png" alt="Mộc Store">
                    </a>
                    <div class="site-title-wrap">                    
                        <p class="site-title">
                            <a  href="index.php?web_moc=Trangchu">Mộc Store</a>
                        </p>
                        <p class="site-description">Cây cảnh Decor</p>
                    </div>
                </div>    
                <div class="header-contact"> 
                    <div class="contact-block ">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                        <span class="title_phone">Điện thoại</span>
                        <p class="content_phone"><a href="tel:+8492849682">+(84) 92849682</a></p>
                    </div>
                    <div class="contact-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                            </svg>
                        <span class="title_email">Email</span>
                        <p class="content_email">
                            <a href="mailto:1812816@dlu.edu.vn">mocstore@gmail.com</a>
                        </p>                
                    </div>
                    <div class="contact-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                        <span class="title_hopening-">Giờ mở cửa</span>
                        <p class="content_hopening">Mon - Fri: 7AM - 10PM</p>                
                    </div>
                </div>
            </div>
            <div class="nav-wrap">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?web_moc=Trangchu">Trang chủ <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Danh mục sản phẩm
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <?php
                                      $sql_product_post= mysqli_query($con, "SELECT * FROM productlines");
                                      while ($row_sanpham = mysqli_fetch_array($sql_product_post)) {
                                    ?>
                                <a class="dropdown-item" href="index.php?web_moc=Danhmucsanpham&id=<?php echo $row_sanpham['productLineCode']?>"><?php echo $row_sanpham['productLineName']?></a>
                               <?php
                            }
                            ?>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?web_moc=Baiviet">Bài viết</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?web_moc=Lienhe">Liên hệ</a>
                            </li>
                            <form action="index.php?web_moc=Timkiemsanpham" method="post">
                            <input type="text"placeholder="Search" name="tukhoa" aria-label="Search">
                            <input type="submit" class="form-context" name="timkiem" value="Tìm kiếm">

                        </form>
                        </ul>
                        
                    </div>
                </nav>
                
            </div>
        </header>
    <!-- Header Section End -->
   

</body>

</html>