<?php
include "db.php";
include "header.php";

if(!isset($_GET['id'])){
    die("Invalid Request");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Student Not Found");
}
?>

<style>

/* PAGE TITLE */
.page-title{
    font-size:24px;
    font-weight:600;
    margin-bottom:20px;
}

/* FORM CARD */
.form-card{
    max-width:600px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

/* LABEL */
.form-card label{
    font-weight:600;
    display:block;
    margin-top:15px;
    margin-bottom:5px;
}

/* INPUT */
.form-card input,
.form-card select{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:15px;
    transition:0.3s;
}

.form-card input:focus,
.form-card select:focus{
    border-color:#2563eb;
    outline:none;
    box-shadow:0 0 5px rgba(37,99,235,0.3);
}

/* BUTTON */
.update-btn{
    margin-top:25px;
    width:100%;
    padding:12px;
    background:#2563eb;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.update-btn:hover{
    background:#1d4ed8;
}

</style>


<div class="page-title">✏️ Edit Student</div>

<div class="form-card">

<form action="update.php" method="POST">

<input type="hidden" name="id"
value="<?php echo $data['id']; ?>">

<label>Student Name</label>
<input type="text" name="name"
value="<?php echo $data['name']; ?>" required>

<label>Course</label>
<input type="text" name="course"
value="<?php echo $data['course']; ?>" required>

<label>Semester</label>
<select name="semester" required>

<option value="1" <?php if($data['semester']==1) echo "selected"; ?>>Semester 1</option>
<option value="2" <?php if($data['semester']==2) echo "selected"; ?>>Semester 2</option>
<option value="3" <?php if($data['semester']==3) echo "selected"; ?>>Semester 3</option>
<option value="4" <?php if($data['semester']==4) echo "selected"; ?>>Semester 4</option>
<option value="5" <?php if($data['semester']==5) echo "selected"; ?>>Semester 5</option>
<option value="6" <?php if($data['semester']==6) echo "selected"; ?>>Semester 6</option>

</select>

<button type="submit" class="update-btn">
✅ Update Student
</button>

</form>

</div>

<?php include "footer.php"; ?>