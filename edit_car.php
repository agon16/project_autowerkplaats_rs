<?php
	session_start();
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
	if(isset($_POST['add'])) {
		$person_id = $_POST['user'];
		$license_plate = $_POST['license_plate'];
		$model = $_POST['car_model'];
		// $image = $_POST['image'];

		if($person_id == 0) {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Gebruiker niet aangegeven</b></p></div>';
		} else {
			$sql = "UPDATE cars SET person_id = '$person_id', license_plate = '$license_plate', car_model_id = '$model' WHERE id = '$id'";
			if($conn->query($sql)) {
				header("Location: overview_cars.php");
			} else {
				$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
			}
		}
		
	} else {
		//Fetch details
		$sql = "SELECT * FROM cars 
			INNER JOIN persons ON persons.id = cars.person_id WHERE cars.id = '$id'";
		$query = $conn->query($sql);

		// if($query->num_rows == 0) {
		// 	// exit(); // Cancel loading page
		// }

		while ($result = $query->fetch_assoc()) {
			$person_id = $result['person_id'];
			$license_plate = $result['license_plate'];
			$model_id = $result['car_model_id'];
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
					<div align="center"><h2>Auto detail bewerken</h2></div>
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
								<div class="12u$">
									<div class="select-wrapper">
										<select name="user" id="user">
											<option value="0">- Persoon -</option>
											<?php
												$sql = "SELECT id, firstname, lastname FROM persons";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['firstname']).' '.ucfirst($result['lastname']).'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="license_plate" id="license_plate" value="<?php echo $license_plate; ?>" placeholder="Naam" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_model" id="car_model">
											<option value="0">- Auto merk/model -</option>
											<?php
												$sql = "SELECT id, brand, model, manufactured_date FROM car_models";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['brand']).' '.ucfirst($result['model']).' '.ucfirst($result['manufactured_date']).'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Bewerken" class="special" name="add" type="submit"></li>
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
	$("#user").val(<?php echo $person_id; // Set role ID ?>);
	$("#car_model").val(<?php echo $model_id; // Set brand ID ?>);
</script>