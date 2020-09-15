<?php require 'database.php' ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
$query = mysqli_query($conn, "SELECT * FROM test");
$results = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Online Exam Portal - Endeavor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="studentHome.php">Endeavor Edutech</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="studentHome.php">Home</a></li>
                <li><a href="studentProfile.php">Profile</a></li>
                <li><a href="notes.php">Notes</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6 " style="border:px solid red; padding:50px;margin-top:50px" >
                <h1 class="text-center" ><u>Upload Notes</u></h1>
                <form action="notess.php" method="post" enctype="multipart/form-data">
                    <label" for="">Image</label>
                        <input type="file" name="image" >
                        <br>
                        <input type="submit" class="btn btn-primary" name="submit" value="submit">
                </form>
            </div>
            <div class="col-md-6" style="border:px solid red; padding:50px;margin-top:50px">
                <h1><u>Display Records</u></h1>
                <table class="table">
                    <thead>
                       
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">image</th>
                            <th scope="col">Download</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                    <?php $sql= "SElECT * from notes";
                        $query=mysqli_query($conn,$sql);
                        while ($row=mysqli_fetch_array($query)) {
                            ?>
                        
                        <tr>
                            <th scope="row"><?php echo $row['id'];?></th>
                            <?php
                            $ext= explode(".",$row['image']); // explode filename by "."
                            $extension= $ext[1];
                            if ($extension=="jpg" || $extension=="png" || $extension=="jpeg"){
                                ?>
                            <td><img style="width:100px" src="questions/<?= $row['image']; ?> "></td>
                            <?php
                            }else
                            {?>
                            <td><img style="width:100px" src="questions/download.jpeg"></td>
<?php
                            } ?>
                            <td>
                            <a href="downlaod.php?file=<?php echo $row['image']; ?>"  class="btn btn-primary">Download</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>

                        </tr>
                        <?php
                        } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
   