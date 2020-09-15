<?php require 'database.php' ?>

<?php
$name = "image";

if (isset($_POST['submit'])) {
    $target_dir = "questions/";
    $target_file = basename($_FILES["image"]["name"]);
    // print_r($target_file);
    $a = pathinfo($target_file);
        move_uploaded_file($_FILES["image"]["tmp_name"], 'questions/' . $target_file);
        $sql = "INSERT into notes(image)VALUES('$target_file')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('location:notes.php');
        } else {
echo 'error';
        }
    
}

?>