<?php
	session_start();
	require 'includes/head.php';
	require 'backend/db.php';

	$style = "";

	if(isset($_SESSION['message'])) {
		$message = '<div class="box"><p>'.$_SESSION['message'].'</p></div>';
	} else {
		$message = '';
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
							<h1>Overzicht gebruiker's rollen</h1>
						</header>

						<!-- Content -->
						<div class="row 200%">
							<div class="12u 12u$(medium)">

								<!-- Table -->
								<h3>Data filteren</h3>

								<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<div class="row">
										<div class="3u 12u$(xsmall)">
											<input name="term" value="" placeholder="Zoekterm ..." type="text">
										</div>
										<div class="1u 12u$(xsmall)">
											<button class="button" name="searchTerm" type="submit">Resultaten</button>
										</div>
									</div>
								</form>

								<a href="add_role.php" class="button special">Rol toevoegen</a>
									<br><br>

								<div class="table-wrapper">
									<table class="alt">
										<thead id="thead">
											<tr>
												<th>Niveau</th>
												<th>Rol naam</th>
												<th>Toegevoegd op</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											
						<?php
							if(isset($_POST['searchTerm']) && !empty($_POST['term'])) {
								$term = $_POST['term'];

								$sql = "SELECT * FROM user_roles WHERE role LIKE '%$term%'";
								$query = $conn->query($sql);

								if($query->num_rows == 0) {
									echo '<div class="box"><p>Foutmelding komt hierin. <b>Check dit</b></p></div>';
									$style = 'none';
								}

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$level = $result['level'];
									$role = $result['role'];
									$created_at = $result['created_at'];
						?>

									<tr>
										<td><?php echo $level; ?></td>
										<td><?php echo $role; ?></td>
										<td><?php echo $created_at; ?></td>
										<td><a href="edit_role.php?id=<?php echo $id;?>" class="button special icon fa-times">Verwijderen</a><a onclick="remove.role('<?php echo $id.' \', \''.$role ?>')" class="button special icon fa-times">Verwijderen</a></td>
									</tr>

						<?php
								}
							} else {
								$sql = "SELECT * FROM user_roles";
								$query = $conn->query($sql);

								while ($result = $query->fetch_assoc()) {
									$id = $result['id'];
									$level = $result['level'];
									$role = $result['role'];
									$created_at = $result['created_at'];
						?>

									<tr>
										<td><?php echo $level; ?></td>
										<td><?php echo $role; ?></td>
										<td><?php echo $created_at; ?></td>
										<td><a href="edit_role.php?id=<?php echo $id;?>" class="button icon fa-circle">Bewerken</a><a style="margin-left: 20px;" onclick="remove.role('<?php echo $id.' \', \''.$role ?>')" class="button special icon fa-times">Verwijderen</a></td>
									</tr>

						<?php
									}
							}

							echo $message;

						?>

										</tbody>
									</table>
								</div>

							</div>
						</div>

					</section>

			</div>
			<!-- Avatars -->
			<?php
				require 'includes/avatars.php';
			?>
		</div>
	<script type="text/javascript">
		document.getElementById('thead').style.display = '<?php echo $style; ?>';
	</script>

	<!-- Sidebar -->
	<?php
		require 'includes/sidebar.php';
	?>

</div>

<?php
	require 'includes/foot.php';
	unset($_SESSION['message']);
?>