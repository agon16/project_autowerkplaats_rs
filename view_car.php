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
		$image = $result['image'];

		if($company > 0) {
			$company = $company_name;
		} else if($company == 0) {
			$company = "Nee";
		}
	}

	/* Check if there are car revision's available */
	$sql = "SELECT * FROM image_revisions WHERE car_id = '$car_id'";
	$query = $conn->query($sql);

	if($query->num_rows > 1) {
		$revision = '<a href="image_revisions.php?id='.$car_id.'">Revisies</a>';
	} else {
		$revision = '';
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
					<div align="center"><h2>Auto details</h2></div>
				</header>

				<!-- Content -->
				<section id="banner">
					<div class="content">
						<p style="font-size: 1.5em;"><b>Eigenaar: </b><?php echo $fullname; ?></p>
						<p style="font-size: 1.5em;""><b>Auto merk: </b><?php echo $car_name; ?></p>
						<p style="font-size: 1.5em;""><b>Plaat nummer: </b><?php echo $license_plate; ?></p>
						<p style="font-size: 1.5em;""><b>Bouwjaar: </b><?php echo $manufactured_date; ?></p>
						<p style="font-size: 1.5em;""><b>Bedrijfseigendom: </b><?php echo $company; ?></p>
						<p style="font-size: 1.5em;""><b>Personen: </b><?php echo $number_persons; ?></p>
					</div>
					<span class="image object">
						<img src="<?php echo $image; ?>" alt="">
							<br>
						<?php echo $revision; ?>
					</span>

				</section>

				<button class="button" onclick="history.go(-1);">Terug</button>
				<a href="view_car_portal.php?id=<?php echo $car_id; ?>" class="button special icon fa-desktop">Portal</a>
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