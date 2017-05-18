<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	$sql = "DELETE FROM towing_charges WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_towed_cars.php"); // Go back to towed_cars overview page

?>