<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$id = $_GET['id'];

	$sql = "SELECT * FROM users WHERE id = '$id'";
	$query = $conn->query($sql);

	while ($result = $query->fetch_assoc()) {
		$firstname = $result['firstname'];
		$lastname = $result['lastname'];
		$address = $result['address'];
		$email = $result['email'];
		$phone = $result['phone'];
		$role = $result['user_role_id'];
	}

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		// $image = $_POST['image'];
		$password = sha1($_POST['password']);

		$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', address = '$address', email = '$email', phone = '$phone', password = '$password' WHERE id = '$id'";
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
								<div class="12u 12u$(xsmall)">
									<input name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Voornaam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Naam" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="email" id="email" value="<?php echo $email; ?>" placeholder="Email" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="address" id="address" value="<?php echo $address; ?>" placeholder="Adres" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<input name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Tel. nummer" type="text">
								</div>
								<div class="12u$">
									<div class="select-wrapper">
										<select name="user_role" id="user_role">
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
									<input name="password" id="password" value="" placeholder="Password" type="password">
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

<script type="text/javascript">
	$("#user_role").val(<?php echo $role; // Set role ID ?>);
</script>