<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	$user_id = $_SESSION['userID'];

	if(isset($_SESSION['cache_activity'])) {
		$topic 	= $_SESSION['topic'];
		$description = $_SESSION['description'];

		unset($_SESSION['cache_activity']);
	} else {
		$topic 	= "";
		$description = "";
	}

	/**
	* Add activity
	*/
	if(isset($_POST['add'])) {
		$topic = $_POST['topic'];
		$description = $_POST['description'];
		$car_id = $_POST['car_id'];

		$sql = "INSERT INTO activities (user_id, topic, description, car_id, created_at) VALUES ('$user_id', '$topic', '$description', '$car_id', NOW())";
		if($conn->query($sql)) {
			header("Location: overview_activities.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}
	} else if(isset($_POST['register_car'])) {
		$_SESSION['topic'] = $_POST['topic'];
		$_SESSION['description'] = $_POST['description'];

		$_SESSION['cache_activity'] = 1;
		header("Location: add_car.php");
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
					<div align="center"><h2>Werkzaamheid toevoegen</h2></div>
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
									<input name="topic" id="topic" value="<?php echo $topic; ?>" placeholder="Onderwerp" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="description" id="description" value="<?php echo $description; ?>" placeholder="Beschrijving" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_id" id="car_id" required="">
											<option value="">- Welke auto -</option>
											<?php
												$sql = "SELECT persons.firstname, persons.lastname, cars.id, license_plate, car_models.brand, car_models.model FROM cars 
													INNER JOIN car_models ON cars.car_model_id = car_models.id 
													INNER JOIN persons ON cars.person_id = persons.id";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													$value = $result['firstname'].' '.$result['lastname'].' | '.$result['brand'].' '.$result['model'].' '.$result['license_plate'];

													echo '<option value="'.$result['id'].'">'.$value.'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><button class="button" type="submit" name="register_car" id="werkzaamheden_car">Auto registreren</button></li>
									</ul>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
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