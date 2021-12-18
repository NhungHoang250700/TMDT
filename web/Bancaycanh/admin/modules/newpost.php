<?php
include '../db/config.php';
if(isset($_POST['submit'])){
  $tenbaiviet=$_POST['namepost'];
  $tomtat=$_POST['cummeryPost'];
  $noidung=$_POST['contentPost'];
  $chuyenmuc=$_POST['category'];
  $trangthai=$_POST['statusPost'];
  $hinhanh=$_FILES['hinhanh']['name'];
  $sql_insert_post= mysqli_query($con, "INSERT INTO newpost( `name_post`, `image_post`, `summery_post`, `content_post`, `id_category`, `status_display_post`) VALUES ('$tenbaiviet','$hinhanh','$tomtat','$noidung','$chuyenmuc','$trangthai')");
  move_uploaded_file($_FILES["hinhanh"]["tmp_name"], 'image/post/'.basename($_FILES["hinhanh"]["name"]));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/newpost.css"></link>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/content/tables/">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/content/tables/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
    <div class="form-wrap">
        <h2>Thêm bài viết</h2>
        <form  method="POST" action="" enctype="multipart/form-data">
            <div class="form-field">
                <label for="namepost">Tên bài viết</label>
                <input name="namepost" data-success="right" type="text" class="form-control" required="required" value="" size="40" aria-required="true">
            </div>

            <div class="">
                <label >Hình ảnh</label>
                <input name="hinhanh" class="form-context" type="file" size="40" aria-required="true">

            </div>
            <div class="form-field ">
                <label for="cummeryPost">Tóm tắt</label>
                <textarea name="cummeryPost" class="form-context" id="cummeryPost" rows="10" cols="100%"></textarea>
            </div>

            <div class="form-field ">
                <label for="contentPost">Nội dung</label>
                <textarea name="contentPost" class="form-context" id="contentPost" rows="10" cols="100%"></textarea>
            </div>

            <div class="form-field ">Danh mục bài viết
            <select name="category" class="form-context">
            <option value='-1'>-----Chọn chuyên mục-----</option>				

                <!--  -->
                <?php
                    $sql_category_post= mysqli_query($con, "SELECT * FROM category ORDER BY id_category ASC");
                    while ($row_danhmuc = mysqli_fetch_array($sql_category_post)) {

                ?>
                <!--  -->
                <option value="<?php echo $row_danhmuc['id_category'] ?>" >
                    <!--  -->
                    <?php echo $row_danhmuc['name_category']?>
                    <!--  -->
                </option>
                    <!--  -->
                    <?php
                            }
                    ?>
                    <!--  -->
            </select>
            </div>
            <div class="form-field ">Tình trạng
                <select name="statusPost" class="form-context">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Thêm bài viết">
            </p>
        </form>
        
       
    </div>


   
 
</body>
</html>

