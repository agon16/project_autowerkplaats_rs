<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$id = $_GET['id'];

	$sql = "SELECT activities.*, users.firstname AS u_fname, users.lastname AS u_lname, persons.firstname AS p_fname, persons.lastname AS p_lname FROM activities 
			INNER JOIN users ON users.id = activities.user_id 
			INNER JOIN cars ON cars.id = activities.car_id 
			INNER JOIN persons ON persons.id = cars.person_id 
			WHERE activities.id = '$id'";
	$query = $conn->query($sql);

	if($query->num_rows == 0) {
		exit(); // Cancel loading page
	}

	while ($result = $query->fetch_assoc()) {
		$topic = $result['topic'];
		$description = $result['description'];
		$user_fullname = $result['u_fname'].' '.$result['u_lname'];
		$person_fullname = $result['p_fname'].' '.$result['p_lname'];
		$registered = $result['created_at'];
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
					<div align="center"><h2>Activiteit</h2></div>
				</header>

				<!-- Content -->
				<section id="banner">
					<div class="content">
						<p style="font-size: 1.5em;"><b>Onderwerp: </b><?php echo $topic; ?></p>
						<p style="font-size: 1.5em;""><b>Beschrijving: </b><?php echo $description; ?></p>
						<p style="font-size: 1.5em;""><b>Medewerker: </b><?php echo $user_fullname; ?></p>
						<p style="font-size: 1.5em;""><b>Klant: </b><?php echo $person_fullname; ?></p>
						<p style="font-size: 1.5em;""><b>Tijd geregistreerd: </b><?php echo $registered; ?></p>
					</div>
				</section>

				<button class="button" onclick="history.go(-1);">Terug</button>

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