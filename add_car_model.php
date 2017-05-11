<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Check if there is a cache available from the previous page
	*/
	if(isset($_SESSION['cache'])) {

		switch ($_SESSION['cache']) {
			case 1:
				$page = 'add_car.php';
				break;

			case 2:
				$page = 'add_person.php';
				break;
			
			default:
				$page = 'overview_car_models.php';
				break;
		}

	}



	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$manufactured_date = $_POST['manufactured_date'];
		$number_persons = $_POST['number_persons'];

		$sql = "INSERT INTO car_models (brand, model, manufactured_date, number_persons) VALUES ('$brand', '$model', '$manufactured_date', '$number_persons')";
		if($conn->query($sql)) {
			header("Location: " . $page);
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
					<div align="center"><h2>Auto model toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="brand" id="brand" value="" placeholder="Merk" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="model" id="model" value="" placeholder="Model" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="manufactured_date" id="manufactured_date" value="" placeholder="Bouwjaar" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="number_persons" id="number_persons" value="" placeholder="Aantal personen" type="text">
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