<?php
include 'header.php';
include 'db.php';
?>

<h2>📊 Payment Statement (Course & Semester Wise)</h2>

<?php
$courseQuery=mysqli_query($conn,
"SELECT DISTINCT course FROM fees ORDER BY course");

while($courseRow=mysqli_fetch_assoc($courseQuery)){

$course=$courseRow['course'];

/* COURSE TOTAL */
$totalCourse=mysqli_fetch_assoc(mysqli_query($conn,"
SELECT SUM(amount) AS total 
FROM fees WHERE course='$course'
"));
?>

<div class="topbar">

<h3 style="display:inline;">
🎓 Course : <?php echo $course; ?>
</h3>

<a href="statement_print.php?course=<?php echo $course; ?>"
target="_blank"
class="btn btn-success"
style="float:right;">
🖨 Print Course
</a>

<h4 style="color:green;">
Total Collection : ₹ 
<?php echo $totalCourse['total'] ?? 0; ?>
</h4>

</div>

<?php
$semQuery=mysqli_query($conn,
"SELECT DISTINCT semester FROM fees
WHERE course='$course'
ORDER BY semester");

while($semRow=mysqli_fetch_assoc($semQuery)){

$semester=$semRow['semester'];
?>

<div class="card">

<h4>
Semester : <?php echo $semester; ?>

<a href="statement_print.php?course=<?php echo $course; ?>&semester=<?php echo $semester; ?>"
target="_blank"
class="btn btn-primary"
style="float:right;">
🖨 Print Semester
</a>

</h4>

<table border="1" width="100%" cellpadding="10">
<tr style="background:#2563eb;color:white;">
<th>Student Name</th>
<th>Total Paid</th>
<th>Last Payment Date</th>
</tr>

<?php
$studentQuery=mysqli_query($conn,"
SELECT name,
SUM(amount) AS total_paid,
MAX(date) AS last_date
FROM fees
WHERE course='$course'
AND semester='$semester'
GROUP BY name
");

$total=0;

while($row=mysqli_fetch_assoc($studentQuery)){
$total += $row['total_paid'];
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td>₹ <?php echo $row['total_paid']; ?></td>
<td><?php echo $row['last_date']; ?></td>
</tr>

<?php } ?>

<tr style="background:#16a34a;color:white;font-weight:bold;">
<td>Semester Total</td>
<td colspan="2">₹ <?php echo $total; ?></td>
</tr>

</table>

</div>

<?php
}
}
?>

</div>
</body>
</html>