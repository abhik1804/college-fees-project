<?php
include "db.php";
include "header.php";

$query = mysqli_query($conn,"SELECT * FROM fees ORDER BY id DESC");
?>

<h2>Payment History</h2>

<table style="width:100%; background:white; border-collapse:collapse; box-shadow:0 3px 10px rgba(0,0,0,0.05);">

<tr style="background:#16a34a;color:white;">
    <th style="padding:10px;">Receipt No</th>
    <th>Name</th>
    <th>Course</th>
    <th>Semester</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr style="text-align:center; border-bottom:1px solid #ddd;">
    <td style="padding:10px;"><?php echo $row['receipt_no']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['semester']; ?></td>
    <td>₹<?php echo $row['amount']; ?></td>
    <td><?php echo $row['date']; ?></td>
    <td>
        <a href="print.php?id=<?php echo $row['id']; ?>" 
           style="color:#2563eb; font-weight:bold;">Print</a>
    </td>
</tr>

<?php } ?>

</table>

<?php include "footer.php"; ?>