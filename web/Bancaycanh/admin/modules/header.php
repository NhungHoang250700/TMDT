<?php

session_start();
	if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
		unset($_SESSION['dangnhap']);
		header('Location:login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/header.css"></link>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  
   
        <!-- Header -->
        <!-- <div class="header-admin">
            <div class="profile_logout">
                <a href="index_admin.php?dangxuat=1">Đăng xuất</a>
            </div>
            <div class="profile_name intro">
                <a href="#">Xin chào, <?php echo $_SESSION['username'];?></a>
            </div>
            <div class="profileimage intro">
                <img src="../image/profile.png" width='18px' alt="#"> 
            </div>     
        </div> -->
        <!-- <div class="header_top">
            <div class="container">
            <a href="#">Xin chào, <?php echo $_SESSION['username'];?></a>
            </div>
        </div> -->
        <div class="col-12 header_language" >
                            <a><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php echo $_SESSION['username'];?></a>
                            <div class="profile_logout">
                            <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="index_admin.php?dangxuat=1">Đăng xuất</a></li>
                        </ul>
                            </div>
                        </div>
    </body>
</html>
