<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$id = $_GET['id'];

	$sql = "SELECT * FROM companies WHERE id = '$id'";
	$query = $conn->query($sql);

	if($query->num_rows == 0) {
		exit(); // Cancel loading page
	}

	while ($result = $query->fetch_assoc()) {
		$name = $result['name'];
		$address = $result['address'];
		$email = $result['email'];
		$phone = $result['phone'];
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
					<div align="center"><h2>Bedrijf details</h2></div>
				</header>

				<!-- Content -->
				<section id="banner">
					<div class="content">
						<p style="font-size: 1.5em;"><b>Naam: </b><?php echo $name; ?></p>
						<p style="font-size: 1.5em;""><b>Adres: </b><?php echo $address; ?></p>
						<p style="font-size: 1.5em;""><b>Email: </b><?php echo $email; ?></p>
						<p style="font-size: 1.5em;""><b>Telefoon nummer: </b><?php echo $phone; ?></p>
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