<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$style = "";
	$columns = array('firstname', 'lastname', 'address', 'email', 'phone');
	$columns_view = array('Voornaam', 'Achternaam', 'Adres', 'Email', 'Tel. nummer');

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
							<h1>Overzicht klanten</h1>
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

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Voornaam</th>
												<th>Achternaam</th>
												<th>Adres</th>
												<th>Email</th>
												<th>Tel. nummer</th>
											</tr>
										</thead>
										<tbody>
											
						<?php
							if( isset($_POST['searchTerm']) && !empty($_POST['term']) && $_POST['column'] != "none") {
								$term = $_POST['term'];
								$column = $_POST['column'];
								$column = $columns[$column];

								$sql = "SELECT * FROM persons WHERE $column LIKE '%$term%'";
								$query = $conn->query($sql);

								if($query->num_rows == 0) {
									echo '<div class="box"><p>Foutmelding komt hierin. <b>Geen velden</b></p></div>';
									$style = 'none';
								}

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$firstname = $result['firstname'];
									$lastname = $result['lastname'];
									$address = $result['address'];
									$email = $result['email'];
									$phone = $result['phone'];
									$created_at = $result['created_at'];

								?>

									<tr>
										<td><?php echo $firstname; ?></td>
										<td><?php echo $lastname; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $phone; ?></td>
									</tr>

						<?php
								}
							} else {
								$sql = "SELECT persons.*, cars.id AS id FROM persons LEFT JOIN cars ON cars.person_id = persons.id";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$firstname = $result['firstname'];
									$lastname = $result['lastname'];
									$address = $result['address'];
									$email = $result['email'];
									$phone = $result['phone'];
									$created_at = $result['created_at'];

								?>

									<tr>
										<td><?php echo $firstname; ?></td>
										<td><?php echo $lastname; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $email; ?></td>
										<td><?php echo $phone; ?></td>
										<?php
											if($id > 0) {
												echo '<td><a href="view_car.php?id='.$id.'">Auto details</a></td>';
											} else {
												echo '<td><o>Geen auto</p></td>';
											}
										?>
										
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