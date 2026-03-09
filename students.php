<?php
include "db.php";
include "header.php";

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query = mysqli_query($conn, "SELECT * FROM students 
        WHERE name LIKE '%$search%' 
        OR course LIKE '%$search%' 
        OR semester LIKE '%$search%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM students");
}
?>

<h2>Student List</h2>

<form method="GET" style="margin-bottom:20px;">
    <input type="text" name="search" placeholder="Search student..." 
           value="<?php echo $search; ?>" 
           style="padding:8px;width:250px;">
    <button type="submit" style="padding:8px 12px;">Search</button>
</form>

<table style="width:100%; background:white; border-collapse:collapse; box-shadow:0 3px 10px rgba(0,0,0,0.05);">

<tr style="background:#2563eb;color:white;">
    <th style="padding:10px;">ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Semester</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($query)){ ?>

<tr style="text-align:center; border-bottom:1px solid #ddd;">
    <td style="padding:10px;"><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['semester']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" 
           style="color:#2563eb; font-weight:bold;">Edit</a> | 
        <a href="delete.php?id=<?php echo $row['id']; ?>" 
           style="color:red; font-weight:bold;"
           onclick="return confirm('Are you sure?');">Delete</a>
    </td>
</tr>

<?php } ?>

</table>

<?php include "footer.php"; ?>