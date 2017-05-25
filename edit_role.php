<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	$role_id = $_GET['id'];

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	/**
	* Add user
	*/
	if(isset($_POST['update'])) {
		$level = $_POST['level'];
		$role = $_POST['role'];

		$sql = "UPDATE user_roles SET level = '$level', role = '$role' WHERE id = '$role_id'";
		echo $sql;
		if($conn->query($sql)) {
			header("Location: overview_roles.php");
		} else {
			$box = '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
		}
		
	} else {
		//Fetch details
		$sql = "SELECT * FROM user_roles WHERE id = '$role_id'";
		$query = $conn->query($sql);

		if($query->num_rows == 0) {
			exit(); // Cancel loading page
		}

		while ($result = $query->fetch_assoc()) {
			$level = $result['level'];
			$role = $result['role'];
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
					<div align="center"><h2>Rol bewerken</h2></div>
				</header>

				<!-- Content -->
				<div class="row 200%">
					<div class="4u 12u$(medium)">
						<p style="color: white">.</p>
					</div>
					<div class="4u 12u$(medium)">

						<!-- Login form -->
						<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$role_id; ?>">
							<div class="row uniform">

								<div class="12u 12u$(xsmall)">
									<input name="role" id="role" value="<?php echo $role; ?>" placeholder="Rol" required="" type="text">
								</div>

								<div class="12u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="level" required="" id="level" required="">
											<option value="">- Level -</option>
											<option value="1">Level 1 - Beheerder</option>
											<option value="2">Level 2 - Normaal</option>
											<option value="3">Level 3 - Minimaal</option>
										</select>
									</div>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Bewerken" class="special" name="update" type="submit"></li>
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

<script type="text/javascript">
	$("#level").val(<?php echo $level; // Set role ID ?>);
</script>