<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$style = "";
	$columns = array('persons.firstname', 'persons.lastname', 'brand', 'model', 'license_plate', 'company_id');
	$columns_view = array('Voornaam', 'Achternaam', 'Merk', 'Model', 'Plaat nummer', 'Bedrijfs eigendom');

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
							<h1>Overzicht auto's</h1>
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
													<option value="none">- Filteren op -</option>
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

								<a href="add_car.php" class="button special">Auto toevoegen</a>
									<br><br>

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Voornaam</th>
												<th>Achternaam</th>
												<th>Merk</th>
												<th>Model</th>
												<th>Plaat</th>
												<th>Bedrijf</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
						<?php
							if( isset($_POST['searchTerm']) && !empty($_POST['term']) && $_POST['column'] != "none") {
								$term = $_POST['term'];
								$column = $_POST['column'];
								$column = $columns[$column];

								$sql = "SELECT persons.*, cars.*, companies.name, car_models.brand, car_models.model, car_models.manufactured_date, car_models.number_persons FROM cars 
									INNER JOIN persons ON cars.person_id = persons.id 
									INNER JOIN car_models ON car_models.id = cars.car_model_id 
									LEFT JOIN companies ON cars.company_id = companies.id WHERE $column LIKE '%$term%'";
								$query = $conn->query($sql);

								if($query->num_rows == 0) {
									echo '<div class="box"><p>Foutmelding komt hierin. <b>Geen velden</b></p></div>';
									$style = 'none';
								}

								while ($result = $query->fetch_assoc()) {
									$id = $result['firstname'];
									$firstname = $result['firstname'];
									$lastname = $result['lastname'];
									$brand = $result['brand'];
									$model = $result['model'];
									$license_number = $result['license_plate'];
									$manufactured_date = $result['manufactured_date'];
									$company = $result['company_id'];
									$number_persons = $result['number_persons'];
									$created_at = $result['created_at'];
									if($company == 0) {
										$company = "Nee";
									} else if($company > 0) {
										$company = $result['name'];
									}

						?>

									<tr>
										<td><?php echo $firstname; ?></td>
										<td><?php echo $lastname; ?></td>
										<td><?php echo $brand; ?></td>
										<td><?php echo $model; ?></td>
										<td><?php echo $license_number; ?></td>
										<td><?php echo $company; ?></td>
										<td><a href="view_car.php?id=<?php echo $id; ?>" class="button special icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.car('<?php echo $id; ?>', '<?php echo $brand.' '.$model; ?>')" class="button icon fa-times"></a></td>
									</tr>

						<?php
								}
							} else {
								$sql = "SELECT persons.*, cars.*, companies.name, car_models.brand, car_models.model, car_models.manufactured_date, car_models.number_persons FROM cars 
									INNER JOIN persons ON cars.person_id = persons.id 
									INNER JOIN car_models ON car_models.id = cars.car_model_id 
									LEFT JOIN companies ON cars.company_id = companies.id";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$firstname = $result['firstname'];
									$lastname = $result['lastname'];
									$brand = $result['brand'];
									$model = $result['model'];
									$license_number = $result['license_plate'];
									$manufactured_date = $result['manufactured_date'];
									$company = $result['company_id'];
									$number_persons = $result['number_persons'];
									$created_at = $result['created_at'];
									if($company == 0) {
										$company = "Nee";
									} else if($company > 0) {
										$company = $result['name'];
									}

								?>

									<tr>
										<td><?php echo $firstname; ?></td>
										<td><?php echo $lastname; ?></td>
										<td><?php echo $brand; ?></td>
										<td><?php echo $model; ?></td>
										<td><?php echo $license_number; ?></td>
										<td><?php echo $company; ?></td>
										<td><a href="view_car.php?id=<?php echo $id; ?>" class="button special icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.car('<?php echo $id; ?>', '<?php echo $brand.' '.$model; ?>')" class="button icon fa-times"></a></td>
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
	<script type="text/javascript">
		document.getElementById('thead').style.display = '<?php echo $style; ?>';
	</script>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>