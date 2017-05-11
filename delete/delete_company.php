<?php
	session_start();
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	// Verify if the company is associated to a car
	$sql_det = "SELECT * FROM cars WHERE company_id = '$id'";
	$query_det = $conn->query($sql_det);

	if($query_det->num_rows > 0) {
		$_SESSION['message'] = "Bedrijf mag alleen verwijderd tenzij het niet is geassocieerd met een geregistreerde auto.";
		header("Location: ../overview_companies.php"); // Go back to companies overview page
	} else {
		$sql = "DELETE FROM companies WHERE id = '$id'";
		$conn->query($sql);
		header("Location: ../overview_companies.php"); // Go back to companies overview page
	}

	

?>