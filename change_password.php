<?php
include "db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_POST['change'])){

    $username = $_SESSION['admin'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);

    if($old_password == $row['password']){

        if($new_password == $confirm_password){

            mysqli_query($conn,"UPDATE admin SET password='$new_password' WHERE username='$username'");
            $message = "Password Updated Successfully!";

        } else {
            $message = "New Password & Confirm Password Not Match!";
        }

    } else {
        $message = "Old Password Incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<style>
body{
    font-family:Segoe UI;
    background:#f1f5f9;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.box{
    width:400px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}
input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}
button{
    width:100%;
    padding:10px;
    background:#2563eb;
    color:white;
    border:none;
}
.msg{
    text-align:center;
    margin-bottom:10px;
    color:green;
}
</style>
</head>

<body>

<div class="box">

<h3 style="text-align:center;">Change Password</h3>

<?php if($message!="") echo "<div class='msg'>$message</div>"; ?>

<form method="POST">
<input type="password" name="old_password" placeholder="Old Password" required>
<input type="password" name="new_password" placeholder="New Password" required>
<input type="password" name="confirm_password" placeholder="Confirm Password" required>
<button type="submit" name="change">Update Password</button>
</form>

</div>

</body>
</html>