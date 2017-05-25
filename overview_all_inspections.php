<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if (isset($_GET['id'])) {
		$car_id = $_GET['id'];
	} else {
		exit(); //Stop loading page
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
							<h1>Autokeuringen</h1>
						</header>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<!-- Table -->
								<h3>Data filteren</h3>

								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div class="row">
										<div class="3u 12u$(xsmall)">
											<input name="term" value="" placeholder="Zoekterm ..." type="text">
										</div>
										<div class="3u 12u$(xsmall)">
											<div class="select-wrapper">
												<select name="column" id="column">
													<option value="">- Filteren op -</option>
													<?php
														for ($i=0; $i < count($columns_view); $i++) { 
															echo '<option value="'.$i.'">'.ucfirst($columns_view[$i]).'</option>';
														}
													?>
												</select>
											</div>
										</div>
										<div class="1u 12u$(xsmall)">
											<button class="button" name="searchTerm" type="submit">Resultaten</button>
										</div>
									</div>
								</form>

								<button class="button" onclick="history.go(-1);">Terug</button>
									<br><br>

								<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Klant</th>
												<th>Auto</th>
												<th>Kenteken nr.</th>
												<th>Gekeurd op</th>
												<th>Keuring gepland</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
											<?php
												$sql = "SELECT inspected_cars.id AS ins_id, inspected_cars.inspected_at, inspected_cars.inspection_due, cars.*, persons.*, car_models.* FROM inspected_cars 
												INNER JOIN cars ON cars.id = inspected_cars.car_id 
												INNER JOIN persons ON cars.person_id = persons.id 
												INNER JOIN car_models ON cars.car_model_id = car_models.id 
												WHERE car_id = '$car_id'";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$ins_id = $result['ins_id'];
													$fullname = $result['firstname'].' '.$result['lastname'];
													$car_brand = $result['brand'].' '.$result['model'];
													$license_plate = $result['license_plate'];
													$inspected_at = $result['inspected_at'];
													$inspection_due = $result['inspection_due'];

													?>

											<tr>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $car_brand; ?></td>
												<td><?php echo $license_plate; ?></td>
												<td><?php echo $inspected_at; ?></td>
												<td><?php echo $inspection_due; ?></td>
												<td><a onclick="remove.inspected_car('<?php echo $ins_id; ?>');" class="button special icon fa-circle">Verwijder</a></td>
											</tr>

													<?php
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