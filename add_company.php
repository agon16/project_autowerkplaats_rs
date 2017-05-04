<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		$sql = "INSERT INTO users (name, address, phone, email) VALUES ('$name', '$address', '$phone', '$email')";
		if($conn->query($sql)) {
			header("Location: overview_cars.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}

	} // End isset

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
					<div align="center"><h2>Bedrijf toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="name" id="name" value="" placeholder="Naam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="address" id="address" value="" placeholder="Adres" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="phone" id="phone" value="" placeholder="Telefoon" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="email" id="email" value="" placeholder="Email" type="text">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
										<li><a class="button" onclick="history.go(-1);">Terug</a></li>
									</ul>
								</div>
							</div>
						</form>

						<?php echo $box; ?>

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