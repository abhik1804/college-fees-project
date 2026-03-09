<?php
include "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$course = $_POST['course'];
$semester = $_POST['semester'];

mysqli_query($conn, "
UPDATE students 
SET name='$name', 
    course='$course', 
    semester='$semester' 
WHERE id='$id'
");

header("Location: dashboard.php");
?>