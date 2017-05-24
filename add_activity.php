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
		$target_dir = "uploads/cars/";
		$image = basename($_FILES["photo"]["name"]);
		$newImage = $target_dir.time().$_FILES["photo"]["name"]; //Renamed file

		$sql = "INSERT INTO activities (user_id, topic, description, car_id, created_at) VALUES ('$user_id', '$topic', '$description', '$car_id', NOW())";
		if($conn->query($sql)) {

			$activity_id = $conn->insert_id;

			if(strlen($image) > 0) { // Verify if an image has been selected

				//Fetch car_details -> Old image
				$sql = "SELECT image AS old_image FROM cars WHERE id = '$car_id'";
				$query = $conn->query($sql);
				while ($result = $query->fetch_assoc()) {
					$old_image = $result['old_image'];
				}

				//Update image
				$sql = "UPDATE cars SET image = '$newImage' WHERE id = '$car_id'";
				$conn->query($sql);

				//Revision image
				$sql_rev = "INSERT INTO image_revisions (user_id, car_id, activity_id, image, created_at) VALUES ('$user_id', '$car_id', '$activity_id', '$old_image', NOW())";
				$conn->query($sql_rev);

				$target_file = $target_dir . $image;
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$check = getimagesize($_FILES["photo"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        $uploadOk = 0;
			    }
				if ($uploadOk == 0) {
				} else {
				    move_uploaded_file($_FILES["photo"]["tmp_name"], $newImage); //Rename file
				}

			}

			header("Location: overview_activities.php"); // Go to overview page
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
					<div class="3u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="6u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data"  action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
										<li><input id="btnUpload" class="button" type="button" value="Foto uploaden"></li>
										<li><input value="Toevoegen" class="special" name="add" type="submit"></li>
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