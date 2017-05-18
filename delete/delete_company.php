<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	// Verify if the company is associated to a car
	$sql_det = "SELECT * FROM cars WHERE company_id = '$id'";
	$query_det = $conn->query($sql_det);

	if($query_det->num_rows > 0) {
		print_r(json_encode(array("result" => 0)));
	} else {
		$sql = "DELETE FROM companies WHERE id = '$id'";
		$conn->query($sql);
		print_r(json_encode(array("result" => 1)));
	}

?>