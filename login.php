<?php
include "db.php";
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, 
        "SELECT * FROM admin WHERE username='$username'"
    );

    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);

        if(password_verify($password, $row['password'])){
            $_SESSION['admin'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid Password!";
        }

    } else {
        $error = "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>College Admin Login</title>

<style>

/* RESET */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Segoe UI',sans-serif;
    background-color:#dfe6ee;
}

.login-wrapper{
    width:380px;
}

.logo{
    width:75px;
    display:block;
    margin:0 auto 12px auto;
}

.college-name{
    text-align:center;
    font-size:20px;
    font-weight:600;
    color:#1e293b;
    margin-bottom:4px;
}

.tagline{
    text-align:center;
    font-size:13px;
    color:#64748b;
    margin-bottom:25px;
}

.login-card{
    background:#ffffff;
    padding:35px;
    border-radius:10px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    border-left:5px solid #2563eb;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #cbd5e1;
    font-size:14px;
}

input:focus{
    border-color:#2563eb;
    outline:none;
}

button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:6px;
    background:#2563eb;
    color:white;
    font-size:15px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#1e40af;
}

.error{
    background:#dc2626;
    color:white;
    padding:8px;
    border-radius:5px;
    margin-bottom:15px;
    text-align:center;
}

</style>
</head>

<body>

<div class="login-wrapper">

<img src="images/logo.png" class="logo">

<div class="college-name">
ABC College of Computer Science
</div>

<div class="tagline">
Student Fees Management System
</div>

<div class="login-card">

<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>

</div>

</div>

</body>
</html>