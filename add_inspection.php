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
		$inspected_date = $_POST['inspected_date'];

		$sql = "INSERT INTO inspected_cars (car_id, inspected_at, inspected_date) VALUES ('$car_id', '$inspected_at', '$inspected_date')";
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
									<input name="inspected_at" class="datepicker" onkeypress="return numericOnly(event);" value="" placeholder="YYYY-MM-DD" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="inspected_date" class="datepicker" onkeypress="return numericOnly(event);" value="" placeholder="YYYY-MM-DD" type="text">
								</div>

								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_model" id="car_model" value="<?php echo $car_model; ?>">
											<option value="">- Klant -</option>
											<?php
												$sql = "SELECT cars.id, cars.license_plate, car_models.brand, car_models.model FROM cars INNER JOIN car_models ON cars.car_model_id = car_models.id";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['brand']).' '.ucfirst($result['model']).' '.ucfirst($result['license_plate']).'</option>';
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
	</div>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>