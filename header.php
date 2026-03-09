<?php
// SESSION SAFE START
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "college_info.php";

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $college_name; ?> - Admin Panel</title>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#f1f5f9;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    height:100vh;
    background:#1e293b;
    position:fixed;
    color:white;
    padding-top:20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    font-size:18px;
}

/* MENU */
.sidebar a{
    display:block;
    padding:12px 20px;
    color:white;
    text-decoration:none;
    font-size:14px;
}

.sidebar a:hover{
    background:#334155;
}

/* MAIN CONTENT */
.main{
    margin-left:220px;
    padding:30px;
}

/* TOP BAR */
.topbar{
    background:white;
    padding:15px;
    border-radius:8px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
    margin-bottom:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card-container{
    display:flex;
    gap:20px;
}

.stat-card{
    flex:1;
    padding:25px;
    border-radius:10px;
    color:white;
}

.blue{ background:#2563eb; }
.green{ background:#16a34a; }

</style>
</head>

<body>

<div class="sidebar">

    <!-- COLLEGE NAME AUTO -->
    <h2><?php echo $college_name; ?></h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="students.php">Students</a>
    <a href="payments.php">Payment History</a>
    <a href="payment_statement.php">Payment Statement</a>
    <a href="change_password.php">Change Password</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

<div class="topbar">
<div>
Welcome, <b><?php echo $_SESSION['admin']; ?></b> 👋
</div>

<div>
<b><?php echo $college_name; ?></b>
</div>
</div>