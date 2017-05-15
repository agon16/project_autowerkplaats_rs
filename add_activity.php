<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add activity
	*/
	if(isset($_POST['add'])) {
		$user_id = $_POST['user_id'];
		$topic = $_POST['topic'];
		$description = $_POST['description'];

		$sql = "INSERT INTO users (user_id, topic, description) VALUES ('$user_id', '$topic', '$description')";
		if($conn->query($sql)) {
			echo "OK";
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
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
									<input name="topic" id="topic" value="" placeholder="Onderwerp" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="description" id="description" value="" placeholder="Beschrijving" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select name="user_role" id="user_role">
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