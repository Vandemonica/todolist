<?php
$con = mysqli_connect("localhost","root","","someDb");
$id = $_GET["id"];

mysqli_query($con,"DELETE FROM listTb WHERE id = '$id'");

header("location: To-Do list.php");
?>