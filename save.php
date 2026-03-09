<?php
include "db.php";
include "college_info.php";

/* block direct access */
if(!isset($_POST['name'])){
    header("Location:index.php");
    exit();
}

/* sanitize inputs */
$name = mysqli_real_escape_string($conn,$_POST['name']);
$course = mysqli_real_escape_string($conn,$_POST['course']);
$semester = (int)$_POST['semester'];
$amount = (int)$_POST['amount'];
$date = date("Y-m-d");

/* validation */
if($name=="" || $course=="" || $semester==0 || $amount==0){
echo "<script>alert('Invalid Data');window.location='index.php';</script>";
exit();
}

/* STUDENT CHECK */
$studentCheck=mysqli_query($conn,
"SELECT id FROM students 
WHERE name='$name' AND course='$course' AND semester='$semester'");

if(mysqli_num_rows($studentCheck)==0){
mysqli_query($conn,
"INSERT INTO students(name,course,semester)
VALUES('$name','$course','$semester')");
}

/* DUPLICATE CHECK */
$feeCheck=mysqli_query($conn,
"SELECT id FROM fees 
WHERE name='$name' AND course='$course' AND semester='$semester'");

if(mysqli_num_rows($feeCheck)>0){
echo "<script>alert('Fee already submitted');window.location='index.php';</script>";
exit();
}

/* INSERT FEE */
mysqli_query($conn,
"INSERT INTO fees(name,course,semester,amount,date)
VALUES('$name','$course','$semester','$amount','$date')");

/* RECEIPT NUMBER */
$last_id=mysqli_insert_id($conn);
$receipt_no="RC".str_pad($last_id,4,"0",STR_PAD_LEFT);

mysqli_query($conn,
"UPDATE fees SET receipt_no='$receipt_no' WHERE id='$last_id'");
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
height:48vh;
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

.print-btn{
margin:20px;
padding:10px 20px;
background:#2563eb;
color:white;
border:none;
cursor:pointer;
}

/* PRINT */
@media print{

@page{
size:A4;
margin:5mm;
}

.print-btn{
display:none;
}

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
<tr><td>Receipt No</td><td><?= $receipt_no ?></td></tr>
<tr><td>Date</td><td><?= $date ?></td></tr>
<tr><td>Student Name</td><td><?= $name ?></td></tr>
<tr><td>Course</td><td><?= $course ?></td></tr>
<tr><td>Semester</td><td><?= $semester ?></td></tr>
<tr><td>Amount Paid</td><td>₹ <?= $amount ?></td></tr>
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