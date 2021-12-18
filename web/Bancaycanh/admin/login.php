<?php
session_start();

include '../db/config.php';
if(isset($_POST["submit_login"])) {
   $taikhoan=$_POST["username"];
   $matkhau=$_POST["password"];
   $check=((isset($_POST['remember-me'])!=0)?1:"");

   if($taikhoan == ''|| $matkhau==''){
    echo '<script>alert("Chưa điển đủ thông tin")</script>';
}
   else{
       $sql_selecter_admin= mysqli_query($con, "SELECT * FROM `admin` WHERE username='$taikhoan' AND password='$matkhau' LIMIT 1");
       $count=mysqli_num_rows($sql_selecter_admin);
       $kq_login=mysqli_fetch_array($sql_selecter_admin);
       if($count>0){
           $f_user=$kq_login['username'];
           $f_pass=$kq_login['password'];    
           if($check==1){
               setcookie("$f_user","$f_pass",time()+3600,"/","",0);
               
           }
           $_SESSION['username']= $f_user;
           $_SESSION['password']= $f_pass;

           header('location: index_admin.php');
       }
       else{
        echo '<script>alert("Tài khoản hoặc mật khẩu sai")</script>';
        header('location: login.php');

    }
   }
   exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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
                        <input name="username" data-success="right" type="text" class="form-control" required="required">
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
                    <label class="form-check-label"><input type="checkbox" value="1"> Remember me</label>
                    <input type="submit" class="btn btn-primary" value="Login" name="submit_login">
                </div>
            </form>
        </div>
    </div>
                       
</body>
</html>