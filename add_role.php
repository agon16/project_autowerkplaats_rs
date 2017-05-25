<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add user
	*/
	if(isset($_POST['add'])) {
		$level = $_POST['level'];
		$role = $_POST['role'];

		$sql = "INSERT INTO user_roles (level, role) VALUES ('$level', '$role')";
		if($conn->query($sql)) {
			header("Location: overview_roles.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
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
					<div align="center"><h2>Rol toevoegen</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<div class="row uniform">
								<div class="12u 12u$(xsmall)">
									<input name="role" id="role" value="" placeholder="Rol" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="level" id="level">
											<option value="0">- Level -</option>
											<option value="1">Level 1 - Beheerder</option>
											<option value="2">Level 2 - Normaal</option>
											<option value="3">Level 3 - Minimaal</option>
										</select>
									</div>
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