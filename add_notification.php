<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	if(isset($_SESSION['userID'])) {
		$user_id = $_SESSION['userID'];
	}

	/**
	* Add notification
	*/
	if(isset($_POST['add'])) {
		$topic = $_POST['topic'];
		$description = $_POST['description'];

		$sql = "INSERT INTO notifications (user_id, topic, description, created_at) VALUES ('$user_id', '$topic', '$description', NOW())";
		if($conn->query($sql)) {
			header("Location: dashboard.php");
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
					<div align="center"><h2>Notificatie distribueren</h2></div>
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
									<input name="topic" id="topic" value="" placeholder="Onderwerp" type="text">
								</div>
								<div class="12u 12u$(xsmall)">
									<textarea name="description" id="description" placeholder="Beschrijving" rows="6"></textarea>
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input value="Terug" class="button" type="button" onclick="history.go(-1);"></li>
										<li><input value="Distribueren" class="special" name="add" type="submit"></li>
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