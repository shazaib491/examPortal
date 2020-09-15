<?php
include "database.php";
$id=$_GET['id'];
$sql="DELETE FROM notes WHERE id=$id";
$query=mysqli_query($conn,$sql);
header("Location:notes.php");

?>