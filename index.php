<?php
include "header.php";
?>

<h2>Add Student</h2>

<div class="form-card">

<form method="POST" action="save.php">

<div class="form-row">
<label>Student Name</label>
<input type="text" name="name" required>
</div>

<div class="form-row">
<label>Course</label>
<select name="course" id="course" required onchange="setFees()">
<option value="">Select Course</option>
<option value="BA">BA</option>
<option value="BCOM">BCOM</option>
</select>
</div>

<div class="form-row">
<label>Semester</label>
<select name="semester" required>
<option value="">Select Semester</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
<option>5</option>
<option>6</option>
</select>
</div>

<div class="form-row">
<label>Fees Amount</label>
<input type="number" name="amount" id="amount" readonly>
</div>

<button type="submit" class="btn">Save Student</button>

</form>

</div>

<style>
.form-card{
background:white;
width:500px;
padding:30px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}
.form-row{
margin-bottom:18px;
display:flex;
flex-direction:column;
}
label{
margin-bottom:6px;
font-weight:600;
}
input, select{
padding:10px;
border:1px solid #ccc;
border-radius:6px;
font-size:14px;
}
input:focus, select:focus{
border-color:#2563eb;
outline:none;
}
.btn{
margin-top:10px;
padding:12px;
background:#2563eb;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
font-size:15px;
}
.btn:hover{
background:#1e40af;
}
</style>

<script>
function setFees(){
    var course = document.getElementById("course").value;
    var amountField = document.getElementById("amount");

    if(course === "BA" || course === "BCOM"){
        amountField.value = 300;
    } else {
        amountField.value = "";
    }
}
</script>

<?php
include "footer.php";
?>