<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add towed car
	*/
	if(isset($_POST['add'])) {
		$person_id = $_POST['person_id'];
		$companyPaid = $_POST['companyPaid'];
		$amount = $_POST['amount'];

		$sql = "INSERT INTO towing_charges (person_id, company_covered, cost, created_at) VALUES ('$person_id', '$companyPaid', '$amount', NOW())";
		if($conn->query($sql)) {
			header("Location: overview_towed_cars.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}
	}

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
					<div align="center"><h2>Werkzaamheid toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">

								<div class="12u$">
									<div class="select-wrapper">
										<select name="companyPaid" id="companyPaid" required="">
											<option value="">- Betaald door bedrijf -</option>
											<option value="0">Ja</option>
											<option value="1">Nee</option>
										</select>
									</div>
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="amount" id="amount" value="" placeholder="Bedrag | 5.00" type="text" onkeypress="return numericOnly(event);" required="">
								</div>

								<div class="12u$">
									<div class="select-wrapper">
										<select name="person_id" id="person_id" required="">
											<option value="">- Welke auto -</option>
											<?php
												$sql = "SELECT persons.firstname, persons.lastname, persons.id, license_plate, car_models.brand, car_models.model FROM cars 
													INNER JOIN car_models ON cars.car_model_id = car_models.id 
													INNER JOIN persons ON cars.person_id = persons.id";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$value = $result['firstname'].' '.$result['lastname'].' | '.$result['brand'].' '.$result['model'].' '.$result['license_plate'];

													echo '<option value="'.$result['id'].'">'.$value.'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
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