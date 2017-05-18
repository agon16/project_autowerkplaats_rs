<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$user_role = $_POST['user_role'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$target_dir = 'uploads/cars/';
		$image = basename($_FILES["photo"]["name"]);
		$password = sha1($_POST['password']);

		$sql = "INSERT INTO users (user_role_id, firstname, lastname, address, email, phone, image,  password) VALUES ('$user_role', '$firstname', '$lastname', '$address', '$email', '$phone', $target_dir$image', '$password')";
		if($conn->query($sql)) {
			header("Location: overview_users.php");
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
				<header class="main">
					<div align="center"><h2>GebruikerMedewerker toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="3u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="6u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input required="" name="firstname" id="firstname" value="" placeholder="Voornaam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input required="" name="lastname" id="lastname" value="" placeholder="Naam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input required="" name="email" id="email" value="" placeholder="Email" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input required="" name="address" id="address" value="" placeholder="Adres" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input required="" name="phone" id="phone" value="" placeholder="Tel. nummer" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select required="" name="user_role" id="user_role">
											<option value="">- Medewerker rol -</option>
											<?php
												$sql = "SELECT id, role FROM user_roles";
												$query = $conn->query($sql);

												while ($result = $query->fetch_assoc()) {
													echo '<option value="'.$result['id'].'">'.ucfirst($result['role']).'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="12u$ 12u$(xsmall)">
									<input required="" name="password" id="password" value="" placeholder="Password" type="password">
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