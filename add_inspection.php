<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$car_id = $_POST['car_model'];
		$inspected_at = $_POST['inspected_at'];
		$inspection_due = $_POST['inspection_due'];

		// Drop all leads
		/* Lead is de nieuwe keuring. Bij het fetchen van de data neemt het
		* systeem alleen de rows waar lead=1
		*/
		$sql_ = "UPDATE inspected_cars SET lead = 0 WHERE car_id = '$car_id'";
		$conn->query($sql_); // Execute query

		$sql = "INSERT INTO inspected_cars (car_id, inspected_at, inspection_due, lead) VALUES ('$car_id', '$inspected_at', '$inspection_due', 1)";
		if($conn->query($sql)) {
			header("Location: overview_inspections.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}

	} // End isset

?>
<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
	<div id="main">
		<div class="inner">

			<!-- Header -->
			<?php
				require 'includes/header.php';
			?>

			<!-- Content -->
			<section>
				<header class="main">
					<div align="center"><h2>Auto keuring vernieuwen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="inspected_at" class="datepicker" onkeypress="return dateOnly(event);" value="" placeholder="Gekeurd op:" type="text" required="">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="inspection_due" class="datepicker" onkeypress="return dateOnly(event);" value="" placeholder="Keuring verval datum:" type="text" required="">
								</div>

								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_model" id="car_model" value="<?php echo $car_model; ?>" required="">
											<option value="">- Klant -</option>
											<?php
												$sql = "SELECT cars.id, cars.license_plate, car_models.brand, car_models.model, persons.firstname, persons.lastname FROM cars INNER JOIN car_models ON cars.car_model_id = car_models.id INNER JOIN persons ON cars.person_id = persons.id";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['brand']).' '.ucfirst($result['model']).' '.ucfirst($result['license_plate']).' | '.ucfirst($result['firstname']).' '.ucfirst($result['lastname']).'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
										<li><a class="button" onclick="history.go(-1);">Terug</a></li>
									</ul>
								</div>
							</div>
						</form>

						<?php echo $box; ?>

					</div>
				</div>

			</section>

		</div>
		<!-- Avatars -->
		<?php
			require 'includes/avatars.php';
		?>
	</div>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>