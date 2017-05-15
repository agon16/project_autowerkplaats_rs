<?php
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$id = $_GET['id'];

	$sql_user = "SELECT * FROM users WHERE id = '$id'";
	$query_user = $conn->query($sql_user);

	while ($result = $query_user->fetch_assoc()) {
		$fullname = $result['firstname'].' '.$result['lastname'];
	}

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
							<h1>Werkzaamheden van <?php echo $fullname; ?></h1>
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

								<a href="add_activity.php" class="button special">Werkzaamheid toevoegen</a>
								<br><br>

								<div class="table-wrapper" style="display: <?php echo $style; ?>">
									<table class="alt">
										<thead>
											<tr>
												<th>Topic</th>
												<th>Beschrijving</th>
												<th>Geregistreerd door</th>
												<th>Tijd geregistreerd</th>
											</tr>
										</thead>
										<tbody>
								<?php
									if(isset($_POST['date_range'])) {
										$date1 = $_POST['date1'];
										$date2 = $_POST['date2'];

										$sql = "SELECT * FROM activities INNER JOIN users ON users.id = activities.user_id WHERE activities.created_at BETWEEN '$date1' AND '$date2' AND users.id = '$id'";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$topic = $result['topic'];
											$description = $result['description'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$created_at = $result['created_at'];
								?>

											<tr>
												<td><?php echo $topic; ?></td>
												<td><?php echo $description; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $created_at; ?></td>
											</tr>

								<?php
										}
									} else {
										$sql = "SELECT * FROM activities INNER JOIN users ON users.id = activities.user_id AND users.id = '$id'";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$topic = $result['topic'];
											$description = $result['description'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$created_at = $result['created_at'];
										?>

											<tr>
												<td><?php echo $topic; ?></td>
												<td><?php echo $description; ?></td>
												<td><?php echo $fullname; ?></td>
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