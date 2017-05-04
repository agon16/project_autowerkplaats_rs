<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	$sql = "DELETE FROM companies WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_companies.php"); // Go back to users overview page

?>