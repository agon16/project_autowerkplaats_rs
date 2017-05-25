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
							<h1>Werkzaamheden</h1>
						</header>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<!-- Table -->
								<h3>Datum filter</h3>

								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div class="row">
										<div class="3u 12u$(xsmall)">
											<input name="date1" onkeypress="numericOnly(event);" class="datepicker" value="" placeholder="YYYY-MM-DD" type="text">
										</div>
										<div class="3u 12u$(xsmall)">
											<input name="date2" onkeypress="numericOnly(event);" class="datepicker" value="" placeholder="YYYY-MM-DD" type="text">
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
												<th></th>
											</tr>
										</thead>
										<tbody>
								<?php
									if(isset($_POST['date_range']) && !empty($_POST['date1']) && !empty($_POST['date2'])) {
										$date1 = $_POST['date1'];
										$date2 = $_POST['date2'];

										$sql = "SELECT activities.*, users.firstname, users.lastname FROM activities INNER JOIN users ON users.id = activities.user_id WHERE activities.created_at BETWEEN '$date1' AND '$date2' ORDER BY id DESC";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$id = $result['id'];
											$topic = $result['topic'];
											$description = $result['description'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$created_at = $result['created_at'];

											if(strlen($description) > 55) {
												$description = substr($description, 0, 55);
												$dots = "...";
											} else {
												$dots = "";
											}
								?>

											<tr>
												<td><?php echo $topic; ?></td>
												<td><?php echo $description.$dots; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $created_at; ?></td>
												<td><a href="view_activity.php?id=<?php echo $id; ?>" class="button icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.activity('<?php echo $id; ?>', '<?php echo $topic; ?>')" class="button icon fa-times"></a></td>
											</tr>

								<?php
										}
									} else {
										$sql = "SELECT activities.*, users.firstname, users.lastname FROM activities INNER JOIN users ON users.id = activities.user_id ORDER BY id DESC";
										$query = $conn->query($sql);

										while ($result = $query->fetch_assoc()) {
											$id = $result['id'];
											$topic = $result['topic'];
											$description = $result['description'];
											$fullname = $result['firstname'].' '.$result['lastname'];
											$created_at = $result['created_at'];

											if(strlen($description) > 55) {
												$description = substr($description, 0, 55);
												$dots = "...";
											} else {
												$dots = "";
											}
										?>

											<tr>
												<td><?php echo $topic; ?></td>
												<td><?php echo $description.$dots; ?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $created_at; ?></td>
												<td><a href="view_activity.php?id=<?php echo $id; ?>" class="button icon fa-circle">Bekijken</a><a style="margin-left: 20px;" onclick="remove.activity('<?php echo $id; ?>', '<?php echo $topic; ?>')" class="button icon fa-times"></a></td>
											</tr>

								<?php
											}
									}
								?>
										</tbody>
									</table>
								</div>

							</div>
						</div> <!-- row 200% -->

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
	
</div> <!-- Wrapper -->

<?php
	require 'includes/foot.php';
?>