<?php
	session_start();

	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	// Verify if a car model is associated to a user
	$sql_det = "SELECT * FROM cars WHERE car_model_id = '$id'";
	$query_det = $conn->query($sql_det);

	if($query_det->num_rows > 0) {
		$_SESSION['message'] = "Auto model mag alleen verwijderd tenzij het niet is geassocieerd met een geregistreerde auto.";
		header("Location: ../overview_car_models.php"); // Go back to car models overview page
	} else {
		$sql = "DELETE FROM car_models WHERE id = '$id'";
		$conn->query($sql);
		header("Location: ../overview_car_models.php"); // Go back to car models overview page
	}

?>