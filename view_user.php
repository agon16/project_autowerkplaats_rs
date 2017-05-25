<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	if(!isset($_GET['id'])) {
		exit(); // Cancel loading page
	}

	$user_id = $_GET['id'];

	$sql = "SELECT * FROM users WHERE id = '$user_id'";
	$query = $conn->query($sql);

	if($query->num_rows == 0) {
		exit(); // Cancel loading page
	}

	while ($result = $query->fetch_assoc()) {
		$firstname = $result['firstname'];
		$lastname = $result['lastname'];
		$address = $result['address'];
		$email = $result['email'];
		$phone = $result['phone'];
		$image = $result['image'];
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
					<div align="center"><h2>Gebruiker details</h2></div>
				</header>

				<a href="overview_activities_user.php?id=<?php echo $user_id; ?>" class="button special">Gebruiker's werkzaamheden</a>

				<!-- Content -->
				<section id="banner">
					<div class="content">
						<p style="font-size: 1.5em;"><b>Voornaam: </b><?php echo $firstname; ?></p>
						<p style="font-size: 1.5em;"><b>Achternaam: </b><?php echo $lastname; ?></p>
						<p style="font-size: 1.5em;""><b>Adres: </b><?php echo $address; ?></p>
						<p style="font-size: 1.5em;""><b>Email: </b><?php echo $email; ?></p>
						<p style="font-size: 1.5em;""><b>Telefoon nummer: </b><?php echo $phone; ?></p>
					</div>
					<span class="image object">
						<img src="<?php echo $image ?>" alt="">
					</span>

				</section>

				<button class="button" onclick="history.go(-1);">Terug</button>
				<a href="edit_user.php?id=<?php echo $user_id ?>" class="button special icon fa-edit">Bewerken</a>

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