<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';
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
							<h1>Niet gekeurde auto's</h1>
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

								<a href="add_inspection.php" class="button">Auto keuring toevoegen</a>
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
												$sql = "SELECT * FROM v_inspected_cars WHERE inspection_due < CURDATE()";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$car_id = $result['id'];
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
												<td><a href="overview_all_inspections.php?id=<?php echo $car_id; ?>" class="button special icon fa-circle">Alle keuringen</a><a style="margin-left: 20px;" href="overview_all_inspections.php?id=<?php echo $car_id; ?>" class="button special">Vernieuwen</a></td>
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
		</div>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>