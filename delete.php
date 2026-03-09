<?php
include "db.php";

/* id check */
if(!isset($_GET['id'])){
header("Location: admin.php");
exit();
}

$id = (int)$_GET['id'];

/* get student info from fees table */
$stmt = $conn->prepare("SELECT name,course,semester FROM fees WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(!$data){
header("Location: admin.php");
exit();
}

/* delete fee record */
$stmt = $conn->prepare("DELETE FROM fees WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

/* delete student record */
$stmt = $conn->prepare("DELETE FROM students 
WHERE name=? AND course=? AND semester=?");
$stmt->bind_param("ssi",$data['name'],$data['course'],$data['semester']);
$stmt->execute();

/* redirect */
header("Location: admin.php?msg=deleted");
exit();
?>
