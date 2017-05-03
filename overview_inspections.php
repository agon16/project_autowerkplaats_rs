<?php
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

								<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Gekeurd</th>
												<th>Voornaam</th>
												<th>Achternaam</th>
												<th>Merk</th>
												<th>Model</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											
											<?php
												$sql = "SELECT * FROM cars INNER JOIN users ON users.id = cars.user_id";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$inspected = $result['inspected'];
													$firstname = $result['firstname'];
													$lastname = $result['lastname'];
													$brand = $result['brand'];
													$model = $result['model'];
													
													if($inspected == 0) {
														$inspected = "Nee";
													} else if($inspected == 0) {
														$inspected = "Ja";
													}

													?>

											<tr>
												<td><?php echo $inspected; ?></td>
												<td><?php echo $firstname; ?></td>
												<td><?php echo $lastname; ?></td>
												<td><?php echo $brand; ?></td>
												<td><?php echo $model; ?></td>
												<td><a class="button special icon fa-circle">Bekijken</a></td>
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