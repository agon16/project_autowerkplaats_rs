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
							<h1>Aanmeld overzicht</h1>
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

								<div class="table-wrapper" style="display: <?php echo $style; ?>">
									<table class="alt">
										<thead>
											<tr>
												<th>Voornaam</th>
												<th>Achternaam</th>
												<th>Rol</th>
												<th>Datum/Tijd ingelogd</th>
											</tr>
										</thead>
										<tbody>
								<?php
									if(isset($_POST['date_range'])) {
										$date1 = $_POST['date1'];
										$date2 = $_POST['date2'];

										$sql = "SELECT logs.user_id, logs.created_at AS logged_in_at, users.*, user_roles.* FROM logs INNER JOIN users ON users.id = logs.user_id 
											INNER JOIN user_roles ON users.user_role_id = user_roles.id WHERE logs.created_at BETWEEN '$date1' AND '$date2'";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$firstname = $result['firstname'];
											$lastname = $result['lastname'];
											$role = ucfirst($result['role']);
											$created_at = $result['logged_in_at'];
								?>

											<tr>
												<td><?php echo $firstname; ?></td>
												<td><?php echo $lastname; ?></td>
												<td><?php echo $role; ?></td>
												<td><?php echo $created_at; ?></td>
											</tr>

								<?php
										}
									} else {
										$sql = "SELECT logs.user_id, logs.created_at AS logged_in_at, users.*, user_roles.* FROM logs 
										INNER JOIN users ON users.id = logs.user_id 
										INNER JOIN user_roles ON users.user_role_id = user_roles.id";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$firstname = $result['firstname'];
											$lastname = $result['lastname'];
											$role = ucfirst($result['role']);
											$created_at = $result['logged_in_at'];
								?>

											<tr>
												<td><?php echo $firstname; ?></td>
												<td><?php echo $lastname; ?></td>
												<td><?php echo $role; ?></td>
												<td><?php echo $created_at; ?></td>
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

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
?>