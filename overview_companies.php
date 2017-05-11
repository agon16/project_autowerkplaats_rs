<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$style = "";

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
							<h1>Overzicht bedrijven</h1>
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
										<div class="1u 12u$(xsmall)">
											<button class="button" name="searchTerm" type="submit">Resultaten</button>
										</div>
									</div>
								</form>

								<a href="add_company.php" class="button special">Bedrijf toevoegen</a>
									<br><br>

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Bedrijfsnaam</th>
												<th>Registreerd op</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
						<?php
							if(isset($_POST['searchTerm']) && !empty($_POST['term'])) {
								$term = $_POST['term'];

								$sql = "SELECT * FROM companies WHERE name LIKE '%$term%'";
								$query = $conn->query($sql);

								if($query->num_rows == 0) {
									echo '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
									$style = 'none';
								}

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$name = $result['name'];
									$created_at = $result['created_at'];
						?>

									<tr>
										<td><?php echo $name; ?></td>
										<td><?php echo $created_at; ?></td>
										<td><a href="delete.company('<?php echo $id.' \', \''.$name ?>')" class="button special icon fa-times">Verwijderen</a></td>
									</tr>

						<?php
								}
							} else {
								$sql = "SELECT * FROM companies";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$name = $result['name'];
									$created_at = $result['created_at'];
						?>

									<tr>
										<td><?php echo $name; ?></td>
										<td><?php echo $created_at; ?></td>
										<td><a onclick="remove.company('<?php echo $id.' \', \''.$name ?>')" class="button special icon fa-times">Verwijderen</a></td>
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