<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	$car_id = $_GET['id'];
	$user_id = $_SESSION['userID'];

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
		$old_image = $_POST['old_image'];
		$target_dir = "uploads/cars/";
		$image = basename($_FILES["photo"]["name"]);
		$newImage = $target_dir.time().$_FILES["photo"]["name"]; //Renamed file

		 //Verify if an image has been selected
		if(strlen($image) == 0) {
			$sql = "UPDATE cars SET person_id = '$person_id', license_plate = '$license_plate', car_model_id = '$model' WHERE id = '$car_id'";
		} else {
			$sql = "UPDATE cars SET person_id = '$person_id', license_plate = '$license_plate', car_model_id = '$model', image = '$newImage' WHERE id = '$car_id'";

			//Revision image
			$sql_rev = "INSERT INTO image_revisions (user_id, car_id, image, created_at) VALUES ('$user_id', '$car_id', '$old_image', NOW())";
			$conn->query($sql_rev);
		}

		if($person_id == 0) {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Gebruiker niet aangegeven</b></p></div>';
		} else {
			
			if($conn->query($sql)) {
				header("Location: view_car.php?id=".$car_id);
			} else {
				$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
			}
		}

		$target_file = $target_dir . $image;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
	    if($check !== false) {
	        // echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        // echo "File is not an image.";
	        $uploadOk = 0;
	    }
		// Check if file already exists
		// if (file_exists($target_file)) {
		//     // echo "Sorry, file already exists.";
		//     $uploadOk = 0;
		// }
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    // echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    move_uploaded_file($_FILES["photo"]["tmp_name"], $newImage); //Rename file
		}
		
	} else {
		//Fetch details
		$sql = "SELECT * FROM cars 
			INNER JOIN persons ON persons.id = cars.person_id WHERE cars.id = '$car_id'";
		$query = $conn->query($sql);

		// if($query->num_rows == 0) {
		// 	// exit(); // Cancel loading page
		// }

		while ($result = $query->fetch_assoc()) {
			$person_id = $result['person_id'];
			$license_plate = $result['license_plate'];
			$model_id = $result['car_model_id'];
			$old_image = $result['image'];
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
					<div class="3u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="6u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$car_id; ?>">
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
										<li><input id="btnUpload" class="button" type="button" value="Foto uploaden"></li>
										<li><input value="Bewerken" class="special" name="add" type="submit"></li>
									</ul>
								</div>
								<input style="display: none;" name="photo" type="file">
								<input name="old_image" value="<?php echo $old_image; ?>" type="hidden">
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