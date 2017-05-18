<?php

	require '../backend/db.php'; // Import database
	$id = $_POST['id'];

	// Verify if a car model is associated to a user
	$sql_det = "SELECT * FROM cars WHERE car_model_id = '$id'";
	$query_det = $conn->query($sql_det);

	if($query_det->num_rows > 0) {
		print_r(json_encode(array("result" => 0)));
	} else {
		$sql = "DELETE FROM car_models WHERE id = '$id'";
		$conn->query($sql);
		print_r(json_encode(array("result" => 1)));
	}

?>