<?php
include "db.php";
include "college_info.php";

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM fees WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Exam Fee Receipt</title>

<style>

body{
    font-family:Segoe UI;
    margin:0;
}

/* RECEIPT */
.receipt{
    width:90%;
    height:48vh;   /* HALF PAGE */
    margin:0 auto;
    padding:15px;
    border:1px solid black;
    box-sizing:border-box;
}

/* HEADER */
.header{
    text-align:center;
    border-bottom:2px solid black;
    margin-bottom:10px;
}

/* TABLE */
.table{
    width:100%;
    border-collapse:collapse;
}

.table td{
    border:1px solid black;
    padding:6px;
}

/* SIGN */
.sign{
    margin-top:25px;
    text-align:right;
}

/* PRINT SETTINGS */
@media print{

body{
    margin:0;
}

/* START FROM TOP */
.receipt{
    margin-top:0;
}

/* A4 PAGE */
@page{
    size:A4;
    margin:5mm;
}

.print-btn{
    display:none;
}

}

.print-btn{
    margin:20px;
    padding:10px 20px;
    background:#2563eb;
    color:white;
    border:none;
    cursor:pointer;
}

</style>

</head>

<body>

<div class="receipt">

<div class="header">
<h3><?php echo $college_name; ?></h3>
<b>Exam Fee Receipt</b>
</div>

<table class="table">
<tr><td>Receipt No</td><td><?php echo $data['receipt_no']; ?></td></tr>
<tr><td>Date</td><td><?php echo $data['date']; ?></td></tr>
<tr><td>Student Name</td><td><?php echo $data['name']; ?></td></tr>
<tr><td>Course</td><td><?php echo $data['course']; ?></td></tr>
<tr><td>Semester</td><td><?php echo $data['semester']; ?></td></tr>
<tr><td>Amount Paid</td><td>₹ <?php echo $data['amount']; ?></td></tr>
</table>

<div class="sign">
Authorized Signature
</div>

</div>

<button onclick="window.print()" class="print-btn">
Print Receipt
</button>

</body>
</html>