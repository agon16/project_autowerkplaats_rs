<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	} else {
		$id = $_GET['id'];
	}

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$user_id = $_POST['user'];
		$license_plate = $_POST['license_plate'];
		$model = $_POST['model'];
		$brand = $_POST['brand'];
		$manufactured_date = $_POST['manufactured_date'];
		$number_persons = $_POST['number_persons'];
		// $image = $_POST['image'];

		if($user_id == 0) {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Gebruiker niet aangegeven</b></p></div>';
		} else {
			$sql = "UPDATE cars SET user_id = '$user_id', license_plate = '$license_plate', model = '$model', brand = '$brand', manufactured_date = '$manufactured_date', number_persons = '$number_persons' WHERE id = '$id'";
			if($conn->query($sql)) {
				// echo "OK";
				header("Location: overview_cars.php");
			} else {
				$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
			}
		}
		
	}

	//Fetch details
	$sql = "SELECT * FROM cars INNER JOIN users ON users.id = cars.user_id WHERE cars.id = '$id'";
	$query = $conn->query($sql);

	if($query->num_rows == 0) {
		// exit(); // Cancel loading page
	}

	while ($result = $query->fetch_assoc()) {
		$user_id = $result['user_id'];
		$license_plate = $result['license_plate'];
		$model = $result['model'];
		$brand = $result['brand'];
		$manufactured_date = $result['manufactured_date'];
		$number_persons = $result['number_persons'];
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
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u$">
									<div class="select-wrapper">
										<select name="user" id="user">
											<option value="0">- Gebruiker -</option>
											<?php
												$sql = "SELECT id, firstname, lastname FROM users WHERE user_role_id = 0";
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
								<div class="12u 12u$(xsmall)">
									<input name="model" id="model" value="<?php echo $model; ?>" placeholder="Email" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="brand" id="brand" value="<?php echo $brand; ?>" placeholder="Adres" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="manufactured_date" id="manufactured_date" value="<?php echo $manufactured_date; ?>" placeholder="Tel. nummer" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="number_persons" id="number_persons" value="<?php echo $number_persons; ?>" placeholder="Tel. nummer" type="text">
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
	$("#user").val(<?php echo $user_id; // Set role ID ?>);
</script>