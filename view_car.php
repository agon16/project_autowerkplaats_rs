<?php
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$id = $_GET['id'];

	$sql = "SELECT persons.*, cars.*, companies.name, car_models.brand, car_models.model FROM cars 
	INNER JOIN persons ON cars.person_id = persons.id 
	INNER JOIN car_models ON car_models.id = cars.car_model_id 
	LEFT JOIN companies ON cars.company_id = companies.id WHERE cars.id = '$id'";
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
						<img src="images/pic10.jpg" alt="">
					</span>

				</section>

				<button class="button" onclick="history.go(-1);">Terug</button>
				<a href="edit_car.php?id=<?php echo $id; ?>" class="button special icon fa-edit">Bewerken</a>

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