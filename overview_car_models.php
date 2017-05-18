<?php
	session_start();

	require 'includes/head.php';
	require 'backend/db.php';

	$style = "";
	$columns = array('brand', 'model', 'manufactured_date');
	$columns_view = array('Merk', 'Model', 'Bouwjaar');

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
							<h1>Overzicht auto modellen</h1>
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

								<a href="add_car_model.php" class="button special">Auto model toevoegen</a>
									<br><br>

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Merk</th>
												<th>Model</th>
												<th>Bouwjaar</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
						<?php
							if( isset($_POST['searchTerm']) && !empty($_POST['term']) && isset($_POST['column'])) {
								$term = $_POST['term'];
								$column = $_POST['column'];
								$column = $columns[$column];

								$sql = "SELECT * FROM car_models WHERE $column LIKE '%$term%'";
								$query = $conn->query($sql);

								if($query->num_rows == 0) {
									echo '<div class="box"><p>Geen resultaten uit het <b>zoekterm</b>.</p></div>';
									$style = 'none';
								}

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$brand = $result['brand'];
									$model = $result['model'];
									$manufactured_date = $result['manufactured_date'];

						?>

									<tr>
										<td><?php echo $brand; ?></td>
										<td><?php echo $model; ?></td>
										<td><?php echo $manufactured_date; ?></td>
										<td><a href="edit_car_model.php?id=<?php echo $id; ?>" class="button special icon fa-circle">Bewerken</a><a style="margin-left: 20px;" onclick="remove.car_model('<?php echo $id; ?>','<?php echo $brand.' '.$model.' '.$manufactured_date; ?>')" class="button icon fa-times"></a></td>
									</tr>

						<?php
								}
							} else {
								$sql = "SELECT * FROM car_models";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$brand = $result['brand'];
									$model = $result['model'];
									$manufactured_date = $result['manufactured_date'];

								?>

									<tr>
										<td><?php echo $brand; ?></td>
										<td><?php echo $model; ?></td>
										<td><?php echo $manufactured_date; ?></td>
										<td><a href="edit_car_model.php?id=<?php echo $id; ?>" class="button special icon fa-circle">Bewerken</a><a style="margin-left: 20px;" onclick="remove.car_model('<?php echo $id; ?>','<?php echo $brand.' '.$model.' '.$manufactured_date; ?>')" class="button icon fa-times"></a></td>
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