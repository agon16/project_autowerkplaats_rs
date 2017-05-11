<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	$sql = "DELETE FROM users WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_users.php"); // Go back to users overview page

?>