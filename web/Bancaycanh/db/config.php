<?php
$db='web_bancaycanh';
$con=new mysqli("localhost","root","",$db);
if($con->connect_error){
    die("connection failed ". $con ->connect_error);
}
?>