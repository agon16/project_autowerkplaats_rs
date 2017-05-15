<?php
	session_start();
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	// Verify if the company is associated to a car
	$sql_det = "SELECT * FROM users WHERE user_role_id = '$id'";
	$query_det = $conn->query($sql_det);

	if($query_det->num_rows > 0) {
		$_SESSION['message'] = "Gebruiker rol mag alleen verwijderd tenzij het niet is geassocieerd met een registreerde gebruiker in het systeem.";
		header("Location: ../overview_roles.php"); // Go back to roles overview page
	} else {
		$sql = "DELETE FROM user_roles WHERE id = '$id'";
		$conn->query($sql);
		header("Location: ../overview_roles.php"); // Go back to roles overview page
	}

	

?>