<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	// $style = 'none';

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
							<h1>Gesleepte auto's</h1>
						</header>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<!-- Table -->
								<h3>Datum filter</h3>

								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div class="row">
										<div class="3u 12u$(xsmall)">
											<input name="date1" class="datepicker" value="" placeholder="YYYY-MM-DD" type="text">
										</div>
										<div class="3u 12u$(xsmall)">
											<input name="date2" class="datepicker" value="" placeholder="YYYY-MM-DD" type="text">
										</div>
										<div class="1u 12u$(xsmall)">
											<button class="button" name="date_range" type="submit">Resultaten</button>
										</div>
									</div>
								</form>

								<a href="add_towed_car.php" class="button special">Sleepactie toevoegen</a>
								<br><br>

								<div class="table-wrapper" style="display: <?php echo $style; ?>">
									<table class="alt">
										<thead>
											<tr>
												<th>Auto</th>
												<th>Eigenaar</th>
												<th>Kenteken nummer</th>
												<th>Bedrijf</th>
												<th>Betaald door bedrijf</th>
												<th>Tijd geregistreerd</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
								<?php
									if(isset($_POST['date_range']) && !empty($_POST['date1']) && !empty($_POST['date2'])) {
										$date1 = $_POST['date1'];
										$date2 = $_POST['date2'];

										$sql = "SELECT persons.*, cars.*, companies.name, car_models.brand, towing_charges.created_at AS created_at, towing_charges.company_covered, car_models.model, car_models.manufactured_date, car_models.number_persons FROM cars 
											INNER JOIN persons ON cars.person_id = persons.id 
											INNER JOIN car_models ON car_models.id = cars.car_model_id 
											INNER JOIN towing_charges ON towing_charges.person_id = persons.id 
											LEFT JOIN companies ON cars.company_id = companies.id WHERE activities.created_at BETWEEN '$date1' AND '$date2'";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$id = $result['id'];
											$company = $result['name'];
											$companyPaid = $result['company_covered'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$car = $result['brand'].' '.$result['model'];
											$license_plate = $result['license_plate'];
											$created_at = $result['created_at'];
								?>

											<tr>
												<td><?php echo $car; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $license_plate; ?></td>
												<td><?php echo $company; ?></td>
												<td><?php echo $companyPaid; ?></td>
												<td><?php echo $created_at; ?></td>
												<td><a href="view_car.php?id=<?php echo $id; ?>" class="button icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.towed_car('<?php echo $id; ?>')" class="button icon fa-times"></a></td>
											</tr>

								<?php
										}
									} else {
										$sql = "SELECT persons.firstname, persons.lastname, cars.*, companies.`name`, 
											    car_models.brand, towing_charges.created_at AS created_at, towing_charges.company_covered, car_models.model, car_models.manufactured_date, 
											    car_models.number_persons FROM cars INNER JOIN car_models ON car_models.id = cars.car_model_id INNER JOIN persons ON persons.id = cars.person_id INNER JOIN towing_charges ON towing_charges.car_id = cars.id LEFT JOIN companies ON cars.company_id = companies.id";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$id = $result['id'];
											$company = $result['name'];
											$companyPaid = $result['company_covered'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$car = $result['brand'].' '.$result['model'];
											$license_plate = $result['license_plate'];
											$created_at = $result['created_at'];

											if($companyPaid == 1) {
												$companyPaid = "Ja";
											} else if($companyPaid == 0) {
												$companyPaid = "Nee";
											}
										?>

											<tr>
												<td><?php echo $car; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $license_plate; ?></td>
												<td><?php echo $company; ?></td>
												<td><?php echo $companyPaid; ?></td>
												<td><?php echo $created_at; ?></td>
												<td><a href="view_car.php?id=<?php echo $id; ?>" class="button icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.towed_car('<?php echo $id; ?>')" class="button icon fa-times"></a></td>
											</tr>

								<?php
											}
									}
								?>
										</tbody>
									</table>
								</div>

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