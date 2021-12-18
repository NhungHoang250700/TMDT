<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index_admin.css"></link>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Marcellus SC' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    
</head>
<body>
    <div class="container-fluid">
    <div class="row header">
        <?php
      include "modules/header.php";
      ?> 
        </div>
<div class="row context1">
  <div class="col-sm-2 menu-left">
      <?php
      include "modules/menu.php";
      ?>
      </div>
  <div class="col-sm-10 main">
  <?php
      include "modules/main.php";
      ?>
  </div>
</div>
</div> 

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
	<script>
        CKEDITOR.replace('cummeryPost');
        CKEDITOR.replace('contentPost');
        CKEDITOR.replace('decriptionproduct');

        decriptionproduct
    </script>
</body>
</html>
