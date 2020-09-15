<?php require'database.php';

$id=$_GET['id'];
$sql= "SElECT * from notes WHERE id=$id";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($query);
  header('Content-Type: application/download');
  header('Content-Disposition: attachment; filename="$row[image]"');
  header("Content-Length: " . filesize("$row[image]"));
  $fp = fopen("$row[image]", "r");
  fpassthru($fp);
  fclose($fp);
?>