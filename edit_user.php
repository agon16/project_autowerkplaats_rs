<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	$user_id = $_GET['id'];

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	/**
	* Add user
	*/
	if(isset($_POST['update'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$target_dir = "uploads/users/";
		$image = basename($_FILES["photo"]["name"]);
		$ext = explode('.', $image);
		$ext_count = count($ext); $ext_count = $ext_count-1;
		$newImage = $target_dir.time().'.'.$ext[$ext_count]; //Renamed file
		$password1 = sha1($_POST['password1']);
		$password2 = sha1($_POST['password2']);

		if($password1 == "da39a3ee5e6b4b0d3255bfef95601890afd80709" || $password2 == "da39a3ee5e6b4b0d3255bfef95601890afd80709") {
			$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', address = '$address', email = '$email', phone = '$phone'";
		} else {
			$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', address = '$address', email = '$email', phone = '$phone', password = '$password1'";
		}

		//Verify if an image has been selected
		if(strlen($image) == 0) {
			$sql_ = " WHERE id = '$user_id'";
		} else {
			$sql_ = ", image = '$newImage' WHERE id = '$user_id'";
		}
		
		if($conn->query($sql.$sql_)) {
			header("Location: view_user.php?id=".$user_id);
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
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
		if (file_exists($target_file)) {
		    // echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    // echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    move_uploaded_file($_FILES["photo"]["tmp_name"], $newImage); //Rename file
		}

	} else {
		$sql = "SELECT * FROM users WHERE id = '$user_id'";
		$query = $conn->query($sql);

		while ($result = $query->fetch_assoc()) {
			$firstname = $result['firstname'];
			$lastname = $result['lastname'];
			$address = $result['address'];
			$email = $result['email'];
			$phone = $result['phone'];
			$role = $result['user_role_id'];
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
					<div class="3u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="6u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$user_id; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="firstname" required="" id="firstname" value="<?php echo $firstname; ?>" placeholder="Voornaam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="lastname" required="" id="lastname" value="<?php echo $lastname; ?>" placeholder="Naam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="email" required="" id="email" value="<?php echo $email; ?>" placeholder="Email" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="address" required="" id="address" value="<?php echo $address; ?>" placeholder="Adres" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="phone" required="" id="phone" value="<?php echo $phone; ?>" placeholder="Tel. nummer" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select name="user_role" required="" id="user_role">
											<option value="">- Gebruiker rol -</option>
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
									<input name="password1" id="password1" value="" placeholder="Password" type="password">
								</div>
								<div class="12u$ 12u$(xsmall)">
									<input name="password2" id="password2" value="" placeholder="Re-type password" type="password">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input id="btnUpload" class="button" type="button" value="Foto uploaden"></li>
										<li><input value="Bewerken" class="special" name="update" type="submit"></li>
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
		<!-- Avatars -->
		<?php
			require 'includes/avatars.php';
		?>
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
	$("#user_role").val(<?php echo $role; // Set role ID ?>);
</script>