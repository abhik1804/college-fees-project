<?php
include "db.php";

$username = "admin";
$password = password_hash("123456", PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO admin (username, password) 
VALUES ('$username', '$password')");

echo "Admin Created";
?>