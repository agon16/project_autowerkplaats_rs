<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	$sql = "DELETE FROM cars WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_cars.php"); // Go back to users overview page

?>