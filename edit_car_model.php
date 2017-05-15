<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	$id = $_GET['id'];

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	/**
	* Add user
	*/
	if(isset($_POST['update'])) {
		$brand = $_POST['brand'];
		$model = $_POST['model'];
		$manufactured_date = $_POST['manufactured_date'];

		$sql = "UPDATE car_models SET brand = '$brand', model = '$model', manufactured_date = '$manufactured_date' WHERE id = '$id'";
		if($conn->query($sql)) {
			// echo "OK";
			header("Location: overview_car_models.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}
		
	} else {
		//Fetch details
		$sql = "SELECT * FROM car_models WHERE id = '$id'";
		$query = $conn->query($sql);

		if($query->num_rows == 0) {
			// exit(); // Cancel loading page
		}

		while ($result = $query->fetch_assoc()) {
			$brand = $result['brand'];
			$model = $result['model'];
			$manufactured_date = $result['manufactured_date'];
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
					<div align="center"><h2>Gebruiker toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id; ?>">
							<div class="row uniform">

								<div class="12u 12u$(xsmall)">
									<input name="brand" id="brand" value="<?php echo $brand; ?>" placeholder="Naam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="model" id="model" value="<?php echo $model; ?>" placeholder="Email" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="manufactured_date" id="manufactured_date" value="<?php echo $manufactured_date; ?>" placeholder="Email" type="text">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Bewerken" class="special" name="update" type="submit"></li>
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

<script type="text/javascript">
	$("#user").val(<?php echo $user_id; // Set role ID ?>);
</script>