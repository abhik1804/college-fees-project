<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body{
    font-family:Segoe UI;
    background:#eef2f7;
    margin:0;
    padding:20px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.title{
    text-align:center;
    font-size:32px;
    margin-bottom:25px;
    font-weight:bold;
    color:#2c3e50;
}

.search{
    text-align:center;
    margin-bottom:25px;
}

.search input{
    padding:10px;
    width:260px;
    border-radius:6px;
    border:1px solid #ccc;
}

.search button{
    padding:10px 18px;
    border:none;
    background:#3498db;
    color:white;
    border-radius:6px;
    cursor:pointer;
}

.search button:hover{
    background:#2980b9;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 3px 12px rgba(0,0,0,0.15);
}

th{
    background:#34495e;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f8f9fa;
}

.action a{
    text-decoration:none;
    padding:6px 12px;
    border-radius:5px;
    color:white;
    font-size:14px;
}

.edit{ background:#27ae60; }
.delete{ background:#e74c3c; }

.edit:hover{ background:#219150;}
.delete:hover{ background:#c0392b;}

.total{
    background:#2c3e50;
    color:white;
    font-weight:bold;
    font-size:18px;
}

.empty{
    text-align:center;
    padding:20px;
    font-size:18px;
    color:#777;
}
</style>
</head>
<body>

<div class="container">

<div class="title">Admin Panel - Fee Records</div>

<div class="search">
<form method="get">
<input type="text" name="search" placeholder="Search student name">
<button>Search</button>
</form>
</div>

<?php
$where="";
if(isset($_GET['search']) && $_GET['search']!=""){
$name=$_GET['search'];
$where="WHERE name LIKE '%$name%'";
}

$q=mysqli_query($conn,"SELECT * FROM fees $where ORDER BY id DESC");

if(mysqli_num_rows($q)==0){
echo "<div class='empty'>No Records Found</div>";
exit;
}

$total=0;

echo "<table>";
echo "<tr>
<th>Receipt</th>
<th>Name</th>
<th>Course</th>
<th>Semester</th>
<th>Amount</th>
<th>Date</th>
<th>Action</th>
</tr>";

while($row=mysqli_fetch_assoc($q)){

$total += $row['amount'];

echo "<tr>
<td>RC-".str_pad($row['id'],3,"0",STR_PAD_LEFT)."</td>
<td>$row[name]</td>
<td>$row[course]</td>
<td>$row[semester]</td>
<td>₹$row[amount]</td>
<td>$row[date]</td>

<td class='action'>
<a class='edit' href='edit.php?id=$row[id]'>Edit</a>
<a class='delete' href='delete.php?id=$row[id]' onclick=\"return confirm('Delete record?')\">Delete</a>
</td>
</tr>";
}

echo "<tr class='total'>
<td colspan=4>Total Collection</td>
<td colspan=3>₹$total</td>
</tr>";

echo "</table>";
?>

</div>
</body>
</html>
