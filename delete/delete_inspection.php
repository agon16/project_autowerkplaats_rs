<?php
	require '../backend/db.php'; // Import database
	$id = $_GET['id'];

	//Get car_id
	$sql = "SELECT car_id FROM inspected_cars WHERE id = '$id'";
	$query = $conn->query($sql);
	$result = $query->fetch_assoc();
	$car_id = $result['car_id'];

	$sql = "DELETE FROM inspected_cars WHERE id = '$id'";
	$conn->query($sql);
	header("Location: ../overview_all_inspections.php?id=".$car_id); // Go back to all_inspections overview page

?>