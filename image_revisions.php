<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$car_id = $_GET['id'];

	$sql = "SELECT * FROM cars INNER JOIN car_models ON cars.car_model_id = car_models.id";
	$query = $conn->query($sql);

	while($result = $query->fetch_assoc()) {
		$car_detail = $result['brand'].' '.$result['model'].' - '.$result['license_plate'];
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
							<h1>Revisie's</h1>
						</header>

						<h3><?php echo $car_detail; ?></h3>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Foto</th>
												<th>Datum geüpload</th>
												<th>Geüpload door</th>
												<th>Activiteit referentie</th>
											</tr>
										</thead>
										<tbody>

						<?php
								$sql = "SELECT image_revisions.*, car_models.brand, car_models.model, cars.license_plate, users.firstname, users.lastname FROM image_revisions LEFT JOIN cars ON cars.id = image_revisions.car_id  LEFT JOIN car_models ON car_models.id = cars.car_model_id INNER JOIN users ON users.id = image_revisions.user_id WHERE cars.id = '$car_id'";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$image = $result['image'];
									$created_at = $result['created_at'];
									$fullname = $result['firstname'].' '.$result['lastname'];
									$activity_id = $result['activity_id'];

									if($activity_id == 0) {
										$activity = "Geen activiteit";
									} else if($activity_id > 0) {
										$activity = '<a class="button" href="view_activity.php?id='.$activity_id.'">Activiteit</a>';
									}
								?>

									<tr>
										<td><center><img src="<?php echo $image; ?>" style="width: 175px; height: auto;"></center></td>
										<td><?php echo $created_at; ?></td>
										<td><?php echo $fullname; ?></td>
										<td><?php echo $activity; ?></td>
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