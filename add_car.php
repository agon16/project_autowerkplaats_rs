<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Verify if there is a cache available from the previous page
	*/
	if(isset($_SESSION['cache_activity'])) {

		switch ($_SESSION['cache_activity']) {
			case 1:
				$page = 'add_activity.php';
				break;
			
			default:
				$page = 'overview_cars.php';
				break;
		}

	} else {
		$page = 'overview_cars.php';
	}

	if(isset($_SESSION['cache'])) {
		$person_id 	= $_SESSION['person_id'];
		$license_plate = $_SESSION['license_plate'];
		$sachi 		= $_SESSION['sachi'];
		$car_model 	= $_SESSION['car_model'];
		$company 	= $_SESSION['company'];

		unset($_SESSION['cache']);
	} else {
		$person_id 	= "";
		$license_plate = "";
		$sachi 		= "";
		$car_model 	= "";
		$company 	= "";
	}

	if(isset($_POST['register_car'])) {
		//Input person details
		$_SESSION['person_id'] = $_POST['person_id'];

		//Input car details
		$_SESSION['license_plate'] = $_POST['license_plate'];
		$_SESSION['sachi'] = $_POST['sachi'];
		$_SESSION['car_model'] = $_POST['car_model'];
		$_SESSION['company'] = $_POST['company'];

		$_SESSION['cache'] = 1;

		header("Location: add_car_model.php"); // Go to page
	} else if(isset($_POST['register_company'])) {
		//Input person details
		$_SESSION['person_id'] = $_POST['person_id'];

		//Input car details
		$_SESSION['license_plate'] = $_POST['license_plate'];
		$_SESSION['sachi'] = $_POST['sachi'];
		$_SESSION['car_model'] = $_POST['car_model'];
		$_SESSION['company'] = $_POST['company'];

		$_SESSION['cache'] = 1;

		header("Location: add_company.php"); // Go to page

	} else 

	/**
	* Add car
	*/
	if(isset($_POST['add'])) {
		//Input person details
		$person_id = $_POST['person_id'];

		//Input car details
		$license_plate = $_POST['license_plate'];
		$sachi = $_POST['sachi'];
		$car_model = $_POST['car_model'];
		$company = $_POST['company'];
		$target_dir = 'uploads/cars/';
		$image = basename($_FILES["photo"]["name"]);

		$sql = "INSERT INTO cars (person_id, car_model_id, sachi_number, license_plate, image, company_id) VALUES ('$person_id', '$car_model', '$sachi', '$license_plate', '$target_dir$image', '$company')";

		if($conn->query($sql)) {
			header("Location: ".$page);
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}

		$target_file = $target_dir . $image;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["photo"]["tmp_name"]);
		    if($check !== false) {
		        // echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        // echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    // echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    // echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
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
					<div class="3u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="6u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div align="center"><h2>Persoons gegevens</h2></div> <!-- Header -->
							<div class="row uniform">
								<div class="12u$">
									<div class="select-wrapper">
										<select name="person_id" id="person_id" value="<?php echo $person_id; ?>" required="">
											<option value="">- Klant -</option>
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

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><button onclick="window.location='add_person.php';" class="button">Klant registreren</button></li>
									</ul>
								</div>
							</div>

								<br>

							<div align="center"><h2>Auto gegevens</h2></div> <!-- Header -->
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="license_plate" id="license_plate" value="<?php echo $license_plate; ?>" placeholder="Plaat nummer" type="text" required="">
								</div>

								<div class="12u$">
									<div class="select-wrapper">
										<select name="car_model" id="car_model" required=""> value="<?php echo $car_model; ?>">
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
									<input name="sachi" id="sachi" value="" placeholder="Sachi" type="text" required="">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><button type="submit" name="register_car" id="register_car" class="button">Auto model registreren</button></li>
									</ul>
								</div>
							</div>

								<br>

							<div align="center"><h2>Bedrijf gegevens</h2></div> <!-- Header -->
							<div class="row uniform">

								<div class="12u$">
									<div class="select-wrapper">
										<select name="company" id="company" required=""> value="<?php echo $company; ?>">
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
										<li><input value="Bedrijf registreren" type="submit" name="register_company" id="register_company"></li>
									</ul>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
										<li><input id="btnUpload" class="button" type="button" value="Foto uploaden"></li>
										<li><a class="button" onclick="history.go(-1);">Terug</a></li>
									</ul>
								</div>
								<input style="display: none;" name="photo" type="file">
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