<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$car_id = $_GET['id'];

	$sql = "SELECT persons.*, cars.*, companies.name, car_models.brand, car_models.model, car_models.manufactured_date, car_models.number_persons FROM cars 
	INNER JOIN persons ON cars.person_id = persons.id 
	INNER JOIN car_models ON car_models.id = cars.car_model_id 
	LEFT JOIN companies ON cars.company_id = companies.id WHERE cars.id = '$car_id'";
	$query = $conn->query($sql);

	if($query->num_rows == 0) {
		exit(); // Cancel loading page
	}

	while ($result = $query->fetch_assoc()) {
		$fullname = $result['firstname'].' '.$result['lastname'];
		$car_name = $result['brand'].' '.$result['model'];
		$license_plate = $result['license_plate'];
		$manufactured_date = $result['manufactured_date'];
		$company = $result['company_id'];
		$company_name = $result['name'];
		$number_persons = $result['number_persons'];

		if($company > 0) {
			$company = $company_name;
		} else if($company == 0) {
			$company = "Nee";
		}
	}

	// Is het gekeurd
	$sql = "SELECT * FROM inspected_cars WHERE car_id = '$car_id' AND inspection_due > CURDATE()";
	$query = $conn->query($sql);
	if($query->num_rows > 0) {
		while ($result = $query->fetch_assoc()) {
			$isInspected = "Ja";
			$inspected_at = $result['inspected_at'];
			$inspection_due = $result['inspection_due'];
		}
	} else {
		$isInspected = "Nee";
		$inspected_at = "N/A";
		$inspection_due = "N/A";
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
					<div align="center"><h2>Auto portal</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<div class="content">
							<p style="font-size: 1.5em;"><b>Eigenaar: </b><?php echo $fullname; ?></p>
							<p style="font-size: 1.5em;""><b>Auto merk: </b><?php echo $car_name; ?></p>
							<p style="font-size: 1.5em;""><b>Plaat nummer: </b><?php echo $license_plate; ?></p>
							<p style="font-size: 1.5em;""><b>Bouwjaar: </b><?php echo $manufactured_date; ?></p>
							<p style="font-size: 1.5em;""><b>Bedrijfseigendom: </b><?php echo $company; ?></p>
							<p style="font-size: 1.5em;""><b>Personen: </b><?php echo $number_persons; ?></p>
							<p style="font-size: 1.5em;""><b>Gekeurd: </b><?php echo $isInspected; ?></p>
							<p style="font-size: 1.5em;""><b>Laatst gekeurd: </b><?php echo $inspected_at; ?></p>
							<p style="font-size: 1.5em;""><b>Keuring verval datum: </b><?php echo $inspection_due; ?></p>
						</div>
					</div>
					<div class="8u 12u$(medium)">

						<!-- Activties -->
						<h3>Werkzaamheden</h3>
						
						<div class="table-wrapper" style="display: <?php echo $style; ?>">
							<table class="alt">
								<thead>
									<tr>
										<th>Onderwerp</th>
										<th>Beschrijving</th>
										<th>Geregistreerd door</th>
										<th>Tijd geregistreerd</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = "SELECT activities.* FROM activities WHERE activities.car_id = '$car_id'";
									$query = $conn->query($sql);

									while ($result = $query->fetch_assoc()) {
										$acc_id = $result['id'];
										$topic = $result['topic'];
										$description = $result['description'];
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
										<td><?php echo $created_at; ?></td>
										<td><a href="view_activity.php?id=<?php echo $acc_id; ?>" class="button icon fa-circle">Bekijken</a></td>
									</tr>

								<?php
									}
								?>
								</tbody>
							</table>
						</div>
						<!-- End activities -->
	
						<!-- Inspections -->
						<h3>Auto keuringen</h3>

						<div class="table-wrapper" style="display: <?php echo $style; ?>">
							<table class="alt">
								<thead>
									<tr>
										<th>Gekeurd op</th>
										<th>Verval datum</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$sql = "SELECT * FROM inspected_cars WHERE car_id = '$car_id' ORDER BY inspected_at DESC LIMIT 0,10";
									$query = $conn->query($sql);

									while ($result = $query->fetch_assoc()) {
										$ins_id = $result['id'];
										$inspected_at = $result['inspected_at'];
										$inspection_due = $result['inspection_due'];
									?>

										<tr>
											<td><?php echo $inspected_at; ?></td>
											<td><?php echo $inspection_due; ?></td>
										</tr>

								<?php
									}
								?>
								</tbody>
							</table>
						</div>
						<a href="overview_all_inspections.php?id=<?php echo $ins_id; ?>">Alle keuringen</a>
						<!-- End inspections -->

					</div>
				</div>

				<button class="button" onclick="history.go(-1);">Terug</button>
				<a href="edit_car.php?id=<?php echo $car_id; ?>" class="button special icon fa-edit">Bewerken</a>

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