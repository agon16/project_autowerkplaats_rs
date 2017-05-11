<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	$sql = "DELETE FROM activities WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_activities.php"); // Go back to activities overview page

?>