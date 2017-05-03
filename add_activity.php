<?php
	require 'includes/head.php';
	require 'backend/db.php';

	$box = "";

	/**
	* Add activity
	*/
	if(isset($_POST['add'])) {
		$user_id = $_POST['user_id'];
		$topic = $_POST['topic'];
		$description = $_POST['description'];

		$sql = "INSERT INTO users (user_id, topic, description) VALUES ('$user_id', '$topic', '$description')";
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
					<div align="center"><h2>Werkzaamheid toevoegen</h2></div>
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
									<input name="description" id="description" value="" placeholder="Beschrijving" type="text">
								</div>

								<!-- Break -->
								<div class="12u$">
									<ul class="actions">
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