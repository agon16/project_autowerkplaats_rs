<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(isset($_SESSION['cache'])) {
		$firstname 	= $_SESSION['firstname'];
		$lastname 	= $_SESSION['lastname'];
		$address 	= $_SESSION['address'];
		$email 		= $_SESSION['email'];
		$phone 		= $_SESSION['phone'];
		$license_plate = $_SESSION['license_plate'];
		$sachi 		= $_SESSION['sachi'];
		$car_model 	= $_SESSION['car_model'];
		$company 	= $_SESSION['company'];

		unset($_SESSION['cache']);
	} else {
		$firstname 	= "";
		$lastname 	= "";
		$address 	= "";
		$email 		= "";
		$phone 		= "";
		$license_plate = "";
		$sachi 		= "";
		$car_model 	= "";
		$company 	= "";
	}

	$box = "";

	if(isset($_POST['register_car'])) {
		//Input person details
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['lastname'] = $_POST['lastname'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['phone'] = $_POST['phone'];

		//Input car details
		$_SESSION['license_plate'] = $_POST['license_plate'];
		$_SESSION['sachi'] = $_POST['sachi'];
		$_SESSION['car_model'] = $_POST['car_model'];
		$_SESSION['company'] = $_POST['company'];

		$_SESSION['cache'] = 2;

		header("Location: add_car_model.php"); // Go to page
	} else if(isset($_POST['register_company'])) {
		//Input person details
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['lastname'] = $_POST['lastname'];
		$_SESSION['address'] = $_POST['address'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['phone'] = $_POST['phone'];

		//Input car details
		$_SESSION['license_plate'] = $_POST['license_plate'];
		$_SESSION['sachi'] = $_POST['sachi'];
		$_SESSION['car_model'] = $_POST['car_model'];
		$_SESSION['company'] = $_POST['company'];

		$_SESSION['cache'] = 2;

		header("Location: add_company.php"); // Go to page
	} else 

	/**
	* Add car
	*/
	if(isset($_POST['add'])) {
		//Input person details
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		//Input car details
		$license_plate = $_POST['license_plate'];
		$sachi = $_POST['sachi'];
		$car_model = $_POST['car_model'];
		$company = $_POST['company'];

		$sql_persons = "INSERT INTO persons (firstname, lastname, address, email, phone) VALUES ('$firstname', '$lastname', '$address', '$email', '$phone')";

		if($conn->query($sql_persons)) {
			$new_person_id = $conn->insert_id;

			$sql_cars = "INSERT INTO cars (person_id, car_model_id, sachi_number, license_plate, company_id) VALUES ('$new_person_id', '$car_model', '$sachi', '$license_plate', '$company')";

			if($conn->query($sql_cars)) {
				header("Location: overview_cars.php");
			} else {
				$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
			}

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

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div align="center"><h2>Persoons gegevens</h2></div> <!-- Header -->
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Voornaam" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Achter" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="address" id="address" value="<?php echo $address; ?>" placeholder="Adres" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="email" id="email" value="<?php echo $email; ?>" placeholder="Email" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Tel. nummer" type="text">
								</div>
							</div>

								<br>

							<div align="center"><h2>Auto gegevens</h2></div> <!-- Header -->
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="license_plate" id="license_plate" value="<?php echo $license_plate; ?>" placeholder="Plaat nummer" type="text">
								</div>

								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_model" id="car_model" value="<?php echo $car_model; ?>">
											<option value="">- Auto model -</option>
											<?php
												$sql = "SELECT id, model, brand FROM car_models";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['brand']).' '.ucfirst($result['model']).'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<div class="12u 12u$(xsmall)">
									<input name="sachi" id="sachi" value="<?php echo $sachi ?>;" placeholder="Sachi" type="text">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><button type="submit" name="register_car" class="button">Auto model registreren</button></li>
									</ul>
								</div>
							</div>

								<br>

							<div align="center"><h2>Bedrijf gegevens</h2></div> <!-- Header -->
							<div class="row uniform">

								<div class="12u$">
									<div class="select-wrapper">
										<select name="company" id="company" value="<?php echo $company; ?>">
											<option value="">- Bedrijf -</option>
											<option value="0">### Geen bedrijfseigendom ###</option>
											<?php
												$sql = "SELECT id, `name` FROM companies";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['name']).'</option>';
												}
											?>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Bedrijf registreren" type="submit" name="register_company"></li>
									</ul>
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